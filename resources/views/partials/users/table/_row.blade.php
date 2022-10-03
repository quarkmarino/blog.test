<tr id="user-{{ $user->id }}">
    <td scope="row">{{ $user->id }}</td>
    <td class="user-user_type">{{ __('user.title.types.' . $user->user_type) }}</td>
    <td class="user-first_name">{{ $user->first_name }}</td>
    <td class="user-last_name">{{ $user->last_name }}</td>
    <td class="user-email">{{ $user->email }}</td>
    <td class="user-supervisors">
        @foreach($user->supervisors->pluck('full_name', 'id') as $supervisorId => $supervisorName)
            <span class="badge badge-primary badge-pill">({{ $supervisorId }}) {{ $supervisorName }}</span>
        @endforeach
    </td>
    <td>{{ optional($user->last_login)->toDayDateTimeString() }}</td>
    <td>
        {{-- <button class="btn btn-success btn-sm view-user" value="{{ $user->id }}">View</button> --}}
        <button class="btn btn-secondary btn-sm edit-user" value="{{ $user->id }}">Edit</button>
        <button class="btn btn-danger btn-sm delete-user" value="{{ $user->id }}">Delete</button>
    </td>
</tr>
