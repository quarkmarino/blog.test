<?php

namespace App\Http\Controllers;

use App\Enums\UserTypeEnum;
use App\Http\Requests\Posts;
use App\Repositories\Contracts\PostRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Prettus\Repository\Criteria\RequestCriteria;

class PostController extends Controller
{
    public function __construct(PostRepository $postRepository){
        $this->postRepository = $postRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        $this->postRepository
            ->with('author')
            ->pushCriteria(app(RequestCriteria::class));

        $this->postRepository->scopeQuery(function($posts) use ($user) {
            switch ($user->user_type) {
                case UserTypeEnum::BLOGGER:
                    return $posts->ofSupervisor($user);
                case UserTypeEnum::SUPERVISOR:
                    return $posts->ofSupervisor($user);
                case UserTypeEnum::ADMIN:
                    return $posts;
            }
        });

        $posts = $this->postRepository->paginate(config('pagination.posts'));


        // TODO: make it fully collection procesed
        $searchFilters = collect(array_filter(explode(';', request()->get('search'))))
            ->mapWithKeys(function ($filter) {
                $filter = explode(':', $filter);
                return [$filter[0] => $filter[1]];
            });

        return view('posts')
            ->with('posts', $posts)
            ->with('searchFilters', $searchFilters);
    }
}
