<table class="table table-striped">
    <thead>
        @include('partials.users.table._filters')
    </thead>
    <tbody>
        @foreach($users as $user)
            @include('partials.users.table._row')
        @endforeach
    </tbody>
</table>

{{ $users->links() }}

@include('partials.users._edit')

@include('partials.users._create')

@push('scripts')
    <script>
        $(document).ready(function() {
            $(document).on('click', '.edit-user', function(e){
                e.preventDefault();

                $('.error-message').html('');

                $('#user-edit-modal').modal('show');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        'Authorization': 'Bearer ' + $('meta[name="api_token"]').attr('content'),
                    }
                });

                var userId = $(this).val();

                $.ajax({
                    type: "GET",
                    url: "{{ route('users.update', '') }}/" + userId,
                    dataType: "json",
                    success: function(response){
                        $('.error-message').html('');

                        $('#edit-id').val(response.id);
                        $('#edit-first_name').val(response.first_name);
                        $('#edit-last_name').val(response.last_name);
                        $('#edit-email').val(response.email);

                        if (response.user_type == '{{ App\Enums\UserTypeEnum::BLOGGER }}') {
                            $('.supervisor-option').attr('selected', false);

                            $(response.supervisor_ids).each(function(key, supervisorId){
                                $(`.supervisor-option[value="${supervisorId}"]`).attr('selected', true)
                            });
                        }
                    }
                });
            });

            $(document).on('click', '.delete-user', function(e){
                e.preventDefault();

                var userId = $(this).val();
                console.log(userId);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        'Authorization': 'Bearer ' + $('meta[name="api_token"]').attr('content'),
                    }
                });

                $.ajax({
                    type: "DELETE",
                    url: `{{ route('users.update', '') }}/${userId}`,
                })
                .done(function(response) {
                    location.reload();
                })
                .fail(function(jqXHR){
                    // if (jqXHR.status == 422) {
                    //     $.each(jqXHR.responseJSON.errors, function(key, errors){
                    //         $(`#user-edit-modal .${key}-errors`).html(errors[0]);
                    //     });
                    // }
                });
            });
        });
    </script>
@endpush
