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

        $this->userRepository->pushCriteria(app(RequestCriteria::class));

        if ($user->user_type === UserTypeEnum::SUPERVISOR) {
            $this->userRepository->scopeQuery(function($query){
                return $query->isBlogger();
            });
        }

        $users = $this->userRepository
            ->paginate(config('pagination.users')/*, $columns = ['*']*/);

        $supervisors = User::isSupervisor()->get();

        $searchFilters = collect(array_filter(explode(';', request()->get('search'))))->mapWithKeys(function ($filter) {
            $filter = explode(':', $filter);
            return [$filter[0] => $filter[1]];
        });

        return view('users')
            ->with('users', $users)
            ->with('supervisors', $supervisors)
            ->with('searchFilters', $searchFilters);
    }
}
