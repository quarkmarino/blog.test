<?php

namespace App\Queries;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SupervisorQueries
{

    public static function usersCount()
    {
        $user = Auth::user();

        return DB::table('users')
            ->join('supervisions', function ($join) {
                $join->on('users.id', '=', 'supervisions.blogger_id');
            })
            ->where('supervisions.supervisor_id', '=', $user->id)
            ->count();
    }

    public static function postsCount()
    {
        $user = Auth::user();

        return DB::table('posts')
            ->join('supervisions', function ($join) {
                $join->on('posts.author_id', '=', 'supervisions.blogger_id');
            })
            ->where('supervisions.supervisor_id', '=', $user->id)
            ->count();
    }
}
