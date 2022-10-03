<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5>Personal Details</h5> <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#profileEditModal">Edit Profile</button>
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
        </dl>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="profileEditModal" tabindex="-1" aria-labelledby="profile-edit-modal-label" aria-hidden="true">
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
                    <input type="text" class="form-control" name="first_name" id="first_name" value="{{ $user->first_name }}">
                    <span class="text-danger error-message" id="errors-first_name"></span>
                </div>
            </div>
            <div class="form-group row">
                <label for="last_name" class="col-sm-3 col-form-label">{{ __('user.title.last_name') }}</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="last_name" id="last_name" value="{{ $user->last_name }}">
                    <span class="text-danger error-message" id="errors-last_name"></span>
                </div>
            </div>
            <div class="form-group row">
                <label for="email" class="col-sm-3 col-form-label">{{ __('user.title.email') }}</label>
                <div class="col-sm-9">
                    <input type="email" class="form-control" name="email" id="email" value="{{ $user->email }}">
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
            $(document).on('click', '#save-profile', function(e){
                e.preventDefault();

                var userData = {
                    'first_name': $('#first_name').val(),
                    'last_name': $('#last_name').val(),
                    'email': $('#email').val(),
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
                    },
                    error: function(jqXHR){
                        $.each(jqXHR.responseJSON.errors, function(key, errors){
                            $(`#errors-${key}`).html(errors[0]);
                        });
                    }
                });
            });
        });
    </script>
@endpush
