<?php
use App\Enums\UserTypeEnum;
?>

<div class="card">
    <div class="card-header">
        <h5>{{ __('user.title.types.' . UserTypeEnum::SUPERVISOR) }} Stats</h5>
    </div>

    <div class="card-body row">
        <dl class="col-sm-12 row">
            <dt class="col-sm-6">Users Count</dt>
            <dd class="col-sm-6">{{ $usersCount->get(UserTypeEnum::SUPERVISOR) }}</dd>
            <dt class="col-sm-6">Posts Count</dt>
            <dd class="col-sm-6">{{ $postsCount->get(UserTypeEnum::SUPERVISOR) }}</dd>
        </dl>
    </div>
</div>
<br>
<div class="card">
    <div class="card-header">
        <h5>{{ __('user.title.types.' . UserTypeEnum::BLOGGER) }} Stats</h5>
    </div>

    <div class="card-body row">
        <dl class="col-sm-12 row">
            <dt class="col-sm-5">Users Count</dt>
            <dd class="col-sm-7">{{ $usersCount->get(UserTypeEnum::BLOGGER) }}</dd>
            <dt class="col-sm-5">Posts Count</dt>
            <dd class="col-sm-7">{{ $postsCount->get(UserTypeEnum::BLOGGER) }}</dd>
        </dl>
    </div>
</div>
