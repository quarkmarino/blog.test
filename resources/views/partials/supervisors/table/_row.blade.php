<tr id="user-{{ $supervisor->id }}">
    <td scope="row">{{ $supervisor->id }}</td>
    <td class="user-user_type">{{ __('user.title.types.' . $supervisor->user_type) }}</td>
    <td class="user-first_name">{{ $supervisor->first_name }}</td>
    <td class="user-last_name">{{ $supervisor->last_name }}</td>
    <td class="user-email">{{ $supervisor->email }}</td>
    <td class="user-bloggers">
        @foreach($supervisor->bloggers->pluck('full_name', 'id') as $bloggerId => $bloggerName)
            <span class="badge badge-success badge-pill">({{ $bloggerId }}) {{ $bloggerName }}</span>
        @endforeach
    </td>
    <td>{{ optional($supervisor->last_login)->toDayDateTimeString() }}</td>
</tr>
