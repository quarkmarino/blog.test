<?php

namespace App\Observers;

use App\Enums\UserTypeEnum;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class UserObserver
{
    /**
     * Handle the user "creating" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function creating(User $user)
    {
        $user->api_token = Hash::make(Carbon::now()->toRfc2822String());
        $user->password = Hash::make($user->password);
    }

    /**
     * Handle the user "saved" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function saved(User $user)
    {
        switch ($user->user_type) {
            case UserTypeEnum::SUPERVISOR:
                $user->supervisors()->detach();
                break;
            case UserTypeEnum::BLOGGER:
                $user->bloggers()->detach();

                $supervisor_ids = request()->input('supervisors', []);

                $user->supervisors()->sync($supervisor_ids);
                break;
        }
    }
}
