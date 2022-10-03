<div class="card">
    <div class="card-header">
        <h5>{{ __('user.title.types.' . App\Enums\UserTypeEnum::BLOGGER) }} Stats</h5>
    </div>

    <div class="card-body row">
        <dl class="col-sm-12 row">
            <dt class="col-sm-5">Users Count</dt>
            <dd class="col-sm-7">{{ $usersCount }}</dd>
            <dt class="col-sm-5">Posts Count</dt>
            <dd class="col-sm-7">{{ $postsCount }}</dd>
        </dl>
    </div>
</div>
