<!-- Modal -->
<div class="modal fade" id="user-create-modal" tabindex="-1" aria-labelledby="user-create-modal-label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="user-create-modal-label">Create New User</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group row">
                        <label for="user_type" class="col-sm-3 col-form-label">{{ __('user.title.user_type') }}</label>
                        <div class="col-sm-9">
                            <select class="form-control form-control-sm" name="user_type" id="user-user_type" placeholder="{{ __('user.title.user_type') }}">
                                @foreach(App\Enums\UserTypeEnum::options() as $userType)
                                    <option value="{{ $userType }}" {{ $userType === App\Enums\UserTypeEnum::BLOGGER ? 'selected' : '' }}>{{ __('user.title.types.' . $userType) }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger error-message user_type-errors"></span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="first_name" class="col-sm-3 col-form-label">{{ __('user.title.first_name') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control user-field" name="first_name" id="user-first_name" value="first_name">
                            <span class="text-danger error-message first_name-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="last_name" class="col-sm-3 col-form-label">{{ __('user.title.last_name') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control user-field" name="last_name" id="user-last_name" value="last_name">
                            <span class="text-danger error-message last_name-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-3 col-form-label">{{ __('user.title.email') }}</label>
                        <div class="col-sm-9">
                            <input type="email" class="form-control user-field" name="email" id="user-email"  value="email@blog.test">
                            <span class="text-danger error-message email-errors"></span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-sm-3 col-form-label">{{ __('user.title.password') }}</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control user-field" name="password" id="user-password"  value="secret">
                            <span class="text-danger error-message password-errors"></span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password_confirmation" class="col-sm-3 col-form-label">{{ __('user.title.password_confirmation') }}</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control user-field" name="password_confirmation" id="user-password_confirmation"  value="secret">
                            <span class="text-danger error-message password_confirmation-errors"></span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="store-user-details">Save User Details</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(document).ready(function() {
            function storeUserDetails() {
                var userData = {
                    'user_type': $('#user-user_type').val(),
                    'first_name': $('#user-first_name').val(),
                    'last_name': $('#user-last_name').val(),
                    'email': $('#user-email').val(),
                    'password': $('#user-password').val(),
                    'password_confirmation': $('#user-password_confirmation').val(),
                };

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        'Authorization': 'Bearer ' + $('meta[name="api_token"]').attr('content'),
                    }
                });

                $('.error-message').html('');

                $.ajax({
                    type: "POST",
                    url: '{{ route('users.store') }}',
                    data: userData,
                    dataType: "json",
                })
                .done(function(response) {
                    window.location.replace(`{{ route('users.page') }}?search=id:${response.id}`);
                })
                .fail(function(jqXHR){
                    if (jqXHR.status == 403) {
                        $('#page-toast .toast-body').html(jqXHR.responseJSON.message);
                        $('#page-toast').toast('show');
                    }
                    if (jqXHR.status == 422) {
                        $.each(jqXHR.responseJSON.errors, function(key, errors){
                            $(`#user-create-modal .${key}-errors`).html(errors[0]);
                        });
                    }
                });
            }

            $(document).on('click', '#store-user-details', function(e){
                e.preventDefault();

                storeUserDetails();
            });

            $('.user-field').on('keypress', function(e){
                if(e.which == 13) {
                    storeUserDetails();
                }
            });
        });
    </script>
@endpush
