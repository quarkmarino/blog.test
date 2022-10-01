<?php

namespace App\Queries;

use Illuminate\Support\Facades\DB;

class AdminQueries
{

    public static function usersCount()
    {
        return DB::table('users')
            ->select(DB::raw('user_type, count(user_type) as users_count'))
            ->groupBy('user_type')
            ->pluck('users_count', 'user_type');
    }

    public static function postsCount()
    {
        return DB::table('posts')
            ->select(DB::raw('users.user_type, count(users.user_type) as posts_count'))
            ->join('users', function ($join) {
                $join->on('posts.author_id', '=', 'users.id');
            })
            ->groupBy('users.user_type')
            ->pluck('posts_count', 'user_type');
    }
}
