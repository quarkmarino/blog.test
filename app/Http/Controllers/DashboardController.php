<?php

namespace App\Http\Controllers;

use App\Enums\UserTypeEnum;
use App\Models\User;
use App\Queries;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();

        switch ($user->user_type) {
            case UserTypeEnum::ADMIN:
                $usersCount = Queries\AdminQueries::usersCount();
                $postsCount = Queries\AdminQueries::postsCount();
            break;
            case UserTypeEnum::SUPERVISOR:
                $user = User::withCount(['posts'])->find(Auth::id());

                $usersCount = Queries\SupervisorQueries::usersCount();
                $postsCount = Queries\SupervisorQueries::postsCount();
            break;
            case UserTypeEnum::BLOGGER:
                $user = User::withCount(['posts', 'supervisors'])->find(Auth::id());

                $usersCount = Queries\SupervisorQueries::usersCount();
                $postsCount = Queries\SupervisorQueries::postsCount();
            break;
        }

        return view('dashboard')
            ->with('user', $user)
            ->with('usersCount', $usersCount ?? null)
            ->with('postsCount', $postsCount ?? null);
    }
}
