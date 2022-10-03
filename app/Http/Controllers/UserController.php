<?php

namespace App\Http\Controllers;

use App\Enums\UserTypeEnum;
use App\Http\Requests\Users;
use App\Models\User;
use App\Repositories\Contracts\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Prettus\Repository\Criteria\RequestCriteria;

class UserController extends Controller
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource paginated by 20.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('index', User::class);

        $user = Auth::user();

        if ($user->user_type === UserTypeEnum::SUPERVISOR) {
            $this->userRepository->scopeQuery(function($query) use ($user){
                return $query->isBlogger()->ofSupervisor($user);
            });
        }

        $users = $this->userRepository
            ->pushCriteria(app(RequestCriteria::class))
            ->paginate(config('pagination.users'));

        $supervisors = User::isSupervisor()->get();

        // TODO: make it fully collection procesed
        $searchFilters = collect(array_filter(explode(';', request()->get('search'))))
            ->mapWithKeys(function ($filter) {
                $filter = explode(':', $filter);
                return [$filter[0] => $filter[1]];
            });

        return view('users')
            ->with('users', $users)
            ->with('supervisors', $supervisors)
            ->with('searchFilters', $searchFilters);
    }

    /**
     * Display a listing of the supervisors with its bloggers paginated by 20.
     *
     * @return \Illuminate\Http\Response
     */
    public function supervisors()
    {
        $this->authorize('supervisors', User::class);

        $supervisors = User::isSupervisor()
            ->with('bloggers')
            ->paginate(config('pagination.users'));

        return view('supervisors')
            ->with('supervisors', $supervisors);
    }
}
