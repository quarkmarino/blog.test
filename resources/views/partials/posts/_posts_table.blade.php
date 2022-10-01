<?php
use App\Enums\UserTypeEnum;
?>

<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">
                <input type="text" class="form-control form-control-sm" name="user[first_name]" placeholder="{{ __('user.title.first_name') }}">
            </th>
            <th scope="col">
                <input type="text" class="form-control form-control-sm" name="user[last_name]" placeholder="{{ __('user.title.last_name') }}">
            </th>
            <th scope="col">
                <input type="text" class="form-control form-control-sm" name="user[email]" placeholder="{{ __('user.title.email') }}">
            </th>
            <th scope="col">
                <select class="form-control form-control-sm" name="user[user_type]" placeholder="{{ __('user.title.user_type') }}">
                    @foreach(UserTypeEnum::options() as $userType)
                        <option value="{{ $userType }}">{{ __('user.title.types.' . $userType) }}</option>
                    @endforeach
                </select>
            </th>
            <th scope="col">
                <input type="date" class="form-control form-control-sm" name="user[last_login][date]" placeholder="{{ __('user.title.last_login') }}">
                {{-- <input type="time" class="form-control form-control-sm" name="user[last_login][time]"> --}}
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach($posts as $user)
            <tr>
                <td scope="row">{{ $user->id }}</td>
                <td>{{ $user->blog_name }}</td>
                <td>{{ $user->description }}</td>
                <td>{{ optional($user->created_at)->toDateTimeString() }}</td>
                <td>{{ optional($user->updated_at)->toDateTimeString() }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

{{ $posts->links() }}
