<tr>
    <th scope="col">
        <input type="number" min="1" step="1" class="form-control form-control-sm user-filter" name="id" placeholder="{{ __('user.title.id') }}" value="{{ $searchFilters->get('id') }}">
    </th>
    <th scope="col">
        <select class="form-control form-control-sm user-filter" name="user_type" id="user-user_type-filter" data-toggle="tooltip" data-placement="top" title="{{ __('user.title.user_type') }}">
            <option value="">-- {{ __('user.title.user_type') }} --</option>

            @foreach(App\Enums\UserTypeEnum::options() as $userType)
                <option value="{{ $userType }}" {{ $searchFilters->get('user_type') == $userType ? 'selected' : '' }}>{{ __('user.title.types.' . $userType) }}</option>
            @endforeach
        </select>
    </th>
    <th scope="col">
        <input type="text" class="form-control form-control-sm user-filter" name="first_name" placeholder="{{ __('user.title.first_name') }}" value="{{ $searchFilters->get('first_name') }}">
    </th>
    <th scope="col">
        <input type="text" class="form-control form-control-sm user-filter" name="last_name" placeholder="{{ __('user.title.last_name') }}" value="{{ $searchFilters->get('last_name') }}">
    </th>
    <th scope="col">
        <input type="email" class="form-control form-control-sm user-filter" name="email" placeholder="{{ __('user.title.email') }}" value="{{ $searchFilters->get('email') }}">
    </th>
    <th scope="col">
        <input type="supervisors" class="form-control form-control-sm user-filter" name="supervisors.full_name" placeholder="{{ __('user.title.supervisors') }}" value="{{ $searchFilters->get('supervisors.full_name') }}">
    </th>
    <th scope="col">
        <input type="date" class="form-control form-control-sm user-filter" name="last_login" value="{{ $searchFilters->get('last_login') }}" data-toggle="tooltip" data-placement="top" title="{{ __('user.title.last_login') }}">
        {{-- <input type="time" class="form-control form-control-sm user-filter" name="last_login-time"> --}}
    </th>
    <th scope="">
        <div class="btn-toolbar d-flex" role="toolbar" aria-label="Toolbar with button groups">
            <div class="btn-group" role="group" aria-label="Search & Filter">
                <button class="btn btn-success btn-sm" id="search-users">Search</button>
                <button class="btn btn-info btn-sm" id="filter-users">Filter</button>
            </div>
            <div class="btn-group" role="group" aria-label="Fields Clearing">
                <button class="btn btn-warning btn-sm" id="clear-filters">Clear</button>
            </div>
        </div>
    </th>
</tr>

@push('scripts')
    <script>
        $(document).ready(function() {
            function getQueryString(searchJoin = 'or'){
                var searchFields = [];

                $('.user-filter').each(function(key, filter){
                    if ($(filter).val() != '') {
                        var filterName = $(filter).attr('name');
                        var filterValue = $(filter).val();

                        searchFields.push(`${filterName}:${filterValue}`);
                    }
                });

                return `${searchFields.join(';')}&searchJoin=${searchJoin}`;
            }

            $('#search-users').on('click', function(e) {
                var searchQuery = getQueryString('or');

                window.location.replace(`{{ route('users.page') }}?search=${searchQuery}`);
            });

            $('#filter-users').on('click', function(e) {
                var searchQuery = getQueryString('and');

                window.location.replace(`{{ route('users.page') }}?search=${searchQuery}`);
            });

            $('#clear-filters').on('click', function(e) {
                $('.user-filter').each(function(key, filter){
                    $(filter).val('')
                });

                var searchQuery = getQueryString('and');

                window.location.replace(`{{ route('users.page') }}?search=${searchQuery}`);
            });

            $('.user-filter').on('keypress', function(e) {
                var filterValue = $(this).val();
                var filterName = $(this).attr('name');

                if(e.which == 13) {
                    var searchQuery = getQueryString();

                    window.location.replace(`{{ route('users.page') }}?search=${searchQuery}`);
                }
            });

            $('#user-user_type-filter').on('change', function() {
                var searchQuery = getQueryString('and');

                window.location.replace(`{{ route('users.page') }}?search=${searchQuery}`);
            });
        });
    </script>
@endpush
