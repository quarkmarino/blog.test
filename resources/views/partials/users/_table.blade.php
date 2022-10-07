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
                    url: "{{ route('users.show', '') }}/" + userId,
                    dataType: "json",
                    success: function(response){
                        $('.error-message').html('');

                        $('#edit-id').val(response.id);
                        $('#edit-user_type').val(response.user_type);
                        $('#edit-first_name').val(response.first_name);
                        $('#edit-last_name').val(response.last_name);
                        $('#edit-email').val(response.email);

                        $('.supervisor-option').prop('selected', false).prop('disabled', true);

                        $('#edit-user_type').prop('disabled', false);
                        $('#edit-user_type.option[value="{{ App\Enums\UserTypeEnum::ADMIN }}"]').prop('disabled', true)

                        switch (response.user_type) {
                            case '{{ App\Enums\UserTypeEnum::ADMIN }}':
                                $('#edit-user_type').prop('disabled', true);
                                break;
                            case '{{ App\Enums\UserTypeEnum::SUPERVISOR }}':
                                break;
                            case '{{ App\Enums\UserTypeEnum::BLOGGER }}':
                                $('.supervisor-option').prop('disabled', false);
                                $(response.supervisor_ids).each(function(key, supervisorId){
                                    $(`.supervisor-option[value="${supervisorId}"]`).prop('selected', true);
                                });
                                break;
                        }

                        $(`.supervisor-option[value="${response.id}"]`).prop('disabled', true)
                        $(`.supervisor-option[value="${response.id}"]`).prop('selected', false)
                    }
                });
            });

            $(document).on('click', '.delete-user', function(e){
                e.preventDefault();

                var userId = $(this).val();

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
                    if (jqXHR.status == 403) {
                        $('#page-toast .toast-body').html(jqXHR.responseJSON.message);
                        $('#page-toast').toast('show');
                    }
                });
            });
        });
    </script>
@endpush
