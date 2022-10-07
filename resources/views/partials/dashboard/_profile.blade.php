<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5>Personal Details</h5>
        <button class="btn btn-sm btn-info edit-profile" data-toggle="modal" data-target="#profile-edit-modal">Edit Profile</button>
    </div>

    <div class="card-body">
        <dl class="row">
            <dt class="col-sm-4">{{ __('user.title.first_name') }}</dt>
            <dd class="col-sm-8" id="user-first_name">{{ $user->first_name }}</dd>

            <dt class="col-sm-4">{{ __('user.title.last_name') }}</dt>
            <dd class="col-sm-8" id="user-last_name">{{ $user->last_name }}</dd>

            <dt class="col-sm-4">{{ __('user.title.email') }}</dt>
            <dd class="col-sm-8" id="user-email">{{ $user->email }}</dd>

            <dt class="col-sm-4">{{ __('user.title.last_login') }}</dt>
            <dd class="col-sm-8" id="user-last_login">{{ optional($user->last_login)->diffForHumans() }}</dd>

            @if($user->is_blogger)
                <dt class="col-sm-4">{{ __('user.title.supervisors') }}</dt>
                <dd class="col-sm-8" id="user-supervisors">
                        {{ $user->supervisors_count ?: 'None' }}
                </dd>
            @endif
        </dl>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="profile-edit-modal" tabindex="-1" aria-labelledby="profile-edit-modal-label" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="profile-edit-modal-label">Edit Personal Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
        <form>
            <div class="form-group row">
                <label for="first_name" class="col-sm-3 col-form-label">{{ __('user.title.first_name') }}</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control profile-edit-field" name="first_name" id="profile-first_name">
                    <span class="text-danger error-message" id="errors-first_name"></span>
                </div>
            </div>
            <div class="form-group row">
                <label for="last_name" class="col-sm-3 col-form-label">{{ __('user.title.last_name') }}</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control profile-edit-field" name="last_name" id="profile-last_name">
                    <span class="text-danger error-message" id="errors-last_name"></span>
                </div>
            </div>
            <div class="form-group row">
                <label for="email" class="col-sm-3 col-form-label">{{ __('user.title.email') }}</label>
                <div class="col-sm-9">
                    <input type="email" class="form-control profile-edit-field" name="email" id="profile-email">
                    <span class="text-danger error-message" id="errors-email"></span>
                </div>
            </div>
        </form>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="save-profile">Save profile</button>
        </div>
    </div>
    </div>
</div>

@push('scripts')
    <script>
        $(document).ready(function() {
            function updateProfileDetails() {
                var userData = {
                    'first_name': $('#profile-first_name').val(),
                    'last_name': $('#profile-last_name').val(),
                    'email': $('#profile-email').val(),
                };

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        'Authorization': 'Bearer ' + $('meta[name="api_token"]').attr('content'),
                    }
                });

                $('.error-message').html('');

                $.ajax({
                    type: "PUT",
                    url: "{{ route('users.update', $user->id) }}",
                    data: userData,
                    dataType: "json",
                    success: function(response){
                        $('.error-message').html('');

                        $('#user-first_name').html(response.first_name);
                        $('#user-last_name').html(response.last_name);
                        $('#user-email').html(response.email);

                        $('#profile-edit-modal').modal('hide');
                    },
                    error: function(jqXHR){
                        if (jqXHR.status == 403) {
                            $('#page-toast .toast-body').html(jqXHR.responseJSON.message);
                            $('#page-toast').toast('show');
                        }
                        if (jqXHR.status == 422) {
                            $.each(jqXHR.responseJSON.errors, function(key, errors){
                                $(`#errors-${key}`).html(errors[0]);
                            });
                        };
                    }
                });
            }

            $(document).on('click', '.edit-profile', function(e){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        'Authorization': 'Bearer ' + $('meta[name="api_token"]').attr('content'),
                    }
                });

                var userId = '{{ $user->id }}';

                $.ajax({
                    type: "GET",
                    url: "{{ route('users.show', '') }}/" + userId,
                    dataType: "json",
                    success: function(response){
                        $('.error-message').html('');

                        $('#profile-first_name').val(response.first_name);
                        $('#profile-last_name').val(response.last_name);
                        $('#profile-email').val(response.email);
                    }
                });
            });

            $(document).on('click', '#save-profile', function(e){
                e.preventDefault();

                updateProfileDetails
            });

            $('.profile-edit-field').on('keypress', function(e){
                if(e.which == 13) {
                    updateProfileDetails();
                }
            });
        });
    </script>
@endpush
