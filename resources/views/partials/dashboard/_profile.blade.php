<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5>Personal Details</h5> <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#profileEditModal">Edit Profile</button>
    </div>

    <div class="card-body">
        <dl class="row">
            <dt class="col-sm-4">{{ __('user.title.first_name') }}</dt>
            <dd class="col-sm-8">{{ $user->first_name }}</dd>

            <dt class="col-sm-4">{{ __('user.title.last_name') }}</dt>
            <dd class="col-sm-8">{{ $user->last_name }}</dd>

            <dt class="col-sm-4">{{ __('user.title.email') }}</dt>
            <dd class="col-sm-8">{{ $user->email }}</dd>

            <dt class="col-sm-4">{{ __('user.title.last_login') }}</dt>
            <dd class="col-sm-8">{{ optional($user->last_login)->diffForHumans() }}</dd>
        </dl>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="profileEditModal" tabindex="-1" aria-labelledby="profileEditModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="profileEditModalLabel">Edit Personal Details</h5>
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
            </div>
          </div>
          <div class="form-group row">
            <label for="last_name" class="col-sm-3 col-form-label">{{ __('user.title.last_name') }}</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" name="last_name" id="last_name" value="{{ $user->last_name }}">
              </div>
          </div>
          <div class="form-group row">
            <label for="email" class="col-sm-3 col-form-label">{{ __('user.title.email') }}</label>
            <div class="col-sm-9">
                <input type="email" class="form-control" name="email" id="email" value="{{ $user->email }}">
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
                // console.log('save button clicked');
                var userData = {
                    'first_name': $('#first_name').val(),
                    'last_name': $('#last_name').val(),
                    'email': $('#email').val(),
                };

                // console.log(userData);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "POST",
                    url: "{{ route('users.store') }}",
                    data: userData,
                    dataType: "json",
                    success: function(response){
                        console.log(response);
                    }
                });

            });
            // $('#profileEditModal').on('shown.bs.modal', function () {
            //     $('#first_name').trigger('focus');
            // });
        });
    </script>
@endpush
