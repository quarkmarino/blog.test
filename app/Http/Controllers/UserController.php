<?php

namespace App\Http\Controllers;

use App\Enums\UserTypeEnum;
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
        $this->authorizeResource(User::class, 'user');

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

        return view('users')->with('users', $users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return User::create($request->input());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->authorize('manage', $user);

        $user->fill($request->input())->save();

        return $user;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->authorize('manage', $user);

        $user->softDelete();

        return response('204', 'resource deleted successfully');
    }
}
