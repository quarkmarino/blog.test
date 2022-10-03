<tr id="user-{{ $user->id }}">
    <td scope="row">{{ $user->id }}</td>
    <td class="user-user_type">{{ __('user.title.types.' . $user->user_type) }}</td>
    <td class="user-first_name">{{ $user->first_name }}</td>
    <td class="user-last_name">{{ $user->last_name }}</td>
    <td class="user-email">{{ $user->email }}</td>
    <td class="user-supervisors">{{ implode(', ', $user->supervisors->pluck('full_name')->toArray()) }}</td>
    <td>{{ optional($user->last_login)->toDayDateTimeString() }}</td>
    <td>
        <div class="btn-group" role="group">
            {{-- <button class="btn btn-success btn-sm view-user" value="{{ $user->id }}">View</button> --}}
            <button class="btn btn-info btn-sm edit-user" value="{{ $user->id }}">Edit</button>
            <button class="btn btn-danger btn-sm delete-user" value="{{ $user->id }}">Delete</button>
        </div>
    </td>
</tr>

{{-- @push('scripts')
    <script>
        $(document).on('click', '.delete-user', function(e){
            e.preventDefault();

            var userId = $(this).val();
            console.log(userId);

            // $.ajax({
            //     type: "DELETE",
            //     url: `{{ route('users.update', '') }}/${userId}`,
            // })
            // .done(function(response) {
            //     location.reload();
            // })
            // .fail(function(jqXHR){
            //     if (jqXHR.status == 422) {
            //         $.each(jqXHR.responseJSON.errors, function(key, errors){
            //             $(`#user-edit-modal .${key}-errors`).html(errors[0]);
            //         });
            //     }
            // });
        });
    </script>
@endpush --}}
