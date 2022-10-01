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
                <input type="email" class="form-control form-control-sm" name="user[email]" placeholder="{{ __('user.title.email') }}">
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
            <th scope="col">
                Actions
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
            <tr>
                <td scope="row">{{ $user->id }}</td>
                <td>{{ $user->first_name }}</td>
                <td>{{ $user->last_name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ __('user.title.types.' . $user->user_type) }}</td>
                <td>{{ optional($user->last_login)->toDateTimeString() }}</td>
                <td></td>
            </tr>
        @endforeach
    </tbody>
</table>

{{ $users->links() }}
