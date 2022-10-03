<tr>
    <th scope="col">
        <input type="number" min="1" step="1" class="form-control form-control-sm post-filter" name="id" placeholder="{{ __('post.title.id') }}" value="{{ $searchFilters->get('id') }}">
    </th>
    <th scope="col">
        <select class="form-control form-control-sm post-filter" name="author.user_type" id="post-user_type-filter" data-toggle="tooltip" data-placement="top" title="{{ __('user.title.user_type') }}">
            <option value="">-- {{ __('user.title.user_type') }} --</option>

            @foreach(App\Enums\UserTypeEnum::options() as $userType)
                <option value="{{ $userType }}" {{ $searchFilters->get('author.user_type') == $userType ? 'selected' : '' }}>{{ __('user.title.types.' . $userType) }}</option>
            @endforeach
        </select>
    </th>
    <th scope="col">
        <input type="text" class="form-control form-control-sm post-filter" name="author.full_name" placeholder="{{ __('post.title.author') }}" value="{{ $searchFilters->get('author.full_name') }}">
    </th>
    <th scope="col">
        <input type="text" class="form-control form-control-sm post-filter" name="blog_name" placeholder="{{ __('post.title.blog_name') }}" value="{{ $searchFilters->get('blog_name') }}">
    </th>
    <th scope="col">
        <input type="text" class="form-control form-control-sm post-filter" name="description" placeholder="{{ __('post.title.description') }}" value="{{ $searchFilters->get('description') }}">
    </th>
    <th scope="col">
        <input type="date" class="form-control form-control-sm post-filter" name="published_at" value="{{ $searchFilters->get('published_at') }}" data-toggle="tooltip" data-placement="top" title="{{ __('post.title.published_at') }}">
    </th>
    <th scope="">
        <div class="btn-group" role="group" aria-label="Search & Filter">
            <button class="btn btn-primary btn-sm" id="search-posts">Search</button>
            <button class="btn btn-info btn-sm" id="filter-posts">Filter</button>
            <button class="btn btn-outline-dark btn-sm" id="clear-filters">Clear</button>
        </div>
    </th>
</tr>

@push('scripts')
    <script>
        $(document).ready(function() {
            function getQueryString(searchJoin = 'or'){
                var searchFields = [];

                $('.post-filter').each(function(key, filter){
                    if ($(filter).val() != '') {
                        var filterName = $(filter).attr('name');
                        var filterValue = $(filter).val();

                        searchFields.push(`${filterName}:${filterValue}`);
                    }
                });

                return `${searchFields.join(';')}&searchJoin=${searchJoin}`;
            }

            $('#search-posts').on('click', function(e) {
                var searchQuery = getQueryString('or');

                window.location.replace(`{{ route('blogs.page') }}?search=${searchQuery}`);
            });

            $('#filter-posts').on('click', function(e) {
                var searchQuery = getQueryString('and');

                window.location.replace(`{{ route('blogs.page') }}?search=${searchQuery}`);
            });

            $('#clear-filters').on('click', function(e) {
                $('.post-filter').each(function(key, filter){
                    $(filter).val('')
                });

                var searchQuery = getQueryString('and');

                window.location.replace(`{{ route('blogs.page') }}?search=${searchQuery}`);
            });

            $('.post-filter').on('keypress', function(e) {
                var filterValue = $(this).val();
                var filterName = $(this).attr('name');

                if(e.which == 13) {
                    var searchQuery = getQueryString();

                    window.location.replace(`{{ route('blogs.page') }}?search=${searchQuery}`);
                }
            });

            $('#post-post_type-filter').on('change', function() {
                var searchQuery = getQueryString('and');

                window.location.replace(`{{ route('blogs.page') }}?search=${searchQuery}`);
            });
        });
    </script>
@endpush
