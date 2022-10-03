<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">{{ __('user.title.id') }}</th>
            <th scope="col">{{ __('user.title.user_type') }}</th>
            <th scope="col">{{ __('user.title.first_name') }}</th>
            <th scope="col">{{ __('user.title.last_name') }}</th>
            <th scope="col">{{ __('user.title.email') }}</th>
            <th scope="col">{{ __('user.title.bloggers') }}</th>
            <th scope="col">{{ __('user.title.last_login') }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach($supervisors as $supervisor)
            @include('partials.supervisors.table._row')
        @endforeach
    </tbody>
</table>

{{ $supervisors->links() }}
