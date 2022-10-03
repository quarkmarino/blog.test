<?php

namespace App\Observers;

use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class UserObserver
{
    /**
     * Handle the user "creating" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function creating(User $user)
    {
        $user->api_token = Hash::make(Carbon::now()->toRfc2822String());
        $user->password = Hash::make($user->password);
    }

    /**
     * Handle the user "deleting" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function deleting(User $user)
    {
        switch ($user->user_type) {
            case UserTypeEnum::SUPERVISOR:
                $user->bloggers()->detach();
                break;
            case UserTypeEnum::BLOGGER:
                $user->supervisors()->detach();
                break;
        }


    }
}
