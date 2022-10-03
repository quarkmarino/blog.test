<!-- Modal -->
<div class="modal fade" id="user-edit-modal" tabindex="-1" aria-labelledby="user-edit-modal-label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="user-edit-modal-label">Edit User Details</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form>
                    <input type="hidden" id="edit-id">
                    <div class="form-group row">
                        <label for="first_name" class="col-sm-3 col-form-label">{{ __('user.title.first_name') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control user-edit-field" name="first_name" id="edit-first_name">
                            <span class="text-danger error-message first_name-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="last_name" class="col-sm-3 col-form-label">{{ __('user.title.last_name') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control user-edit-field" name="last_name" id="edit-last_name">
                            <span class="text-danger error-message last_name-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-3 col-form-label">{{ __('user.title.email') }}</label>
                        <div class="col-sm-9">
                            <input type="email" class="form-control user-edit-field" name="email" id="edit-email">
                            <span class="text-danger error-message email-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="supervisors" class="col-sm-3 col-form-label">{{ __('user.title.supervisors') }}</label>
                        <div class="col-sm-9">
                            <select multiple class="form-control form-control-sm user-edit-field" name="supervisors" id="edit-supervisors">
                                {{-- <option value="" disabled>-- {{ __('user.title.supervisors') }} --</option> --}}

                                @foreach($supervisors as $supervisor)
                                    <option class="supervisor-option" value="{{ $supervisor->id }}">
                                        ({{ $supervisor->id }}) {{ $supervisor->full_name }}
                                    </option>
                                @endforeach
                            </select>
                            <span class="text-danger error-message supervisors-errors"></span>
                        </div>

                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="update-user-details">Update User Details</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(document).ready(function() {
            function updateUserDetails() {
                var userId = $('#edit-id').val();

                var userData = {
                    'first_name': $('#edit-first_name').val(),
                    'last_name': $('#edit-last_name').val(),
                    'email': $('#edit-email').val(),
                };

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        'Authorization': 'Bearer ' + $('meta[name="api_token"]').attr('content'),
                    }
                });

                $.ajax({
                    type: "PUT",
                    url: `{{ route('users.update', '') }}/${userId}`,
                    data: userData,
                    dataType: "json",
                })
                .done(function(response) {
                    $('.error-message').html('');

                    $.ajax({
                        type: "GET",
                        url: `{{ route('users.show', '') }}/${userId}`,
                        contentType:"text/html; charset=UTF-8",
                        success: function(response) {
                            $(`#user-${userId}`).replaceWith(response);
                        }
                    });
                })
                .fail(function(jqXHR){
                    if (jqXHR.status == 422) {
                        $.each(jqXHR.responseJSON.errors, function(key, errors){
                            $(`#user-edit-modal .${key}-errors`).html(errors[0]);
                        });
                    }
                });
            }

            $(document).on('click', '#update-user-details', function(e){
                e.preventDefault();

                updateUserDetails();
            });

            $('.user-edit-field').on('keypress', function(e){
                if(e.which == 13) {
                    updateUserDetails();
                }
            });
        });
    </script>
@endpush
