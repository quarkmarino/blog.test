<table class="table table-striped">
    <thead>
        @include('partials.posts.table._filters')
    </thead>
    <tbody>
        @foreach($posts as $post)
            @include('partials.posts.table._row')
        @endforeach
    </tbody>
</table>

{{ $posts->links() }}

@include('partials.posts._edit')

@include('partials.posts._create')

@push('scripts')
    <script>
        $(document).ready(function() {
            $(document).on('click', '.edit-post', function(e){
                e.preventDefault();

                $('.error-message').html('');

                $('#post-edit-modal').modal('show');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        'Authorization': 'Bearer ' + $('meta[name="api_token"]').attr('content'),
                    }
                });

                var postId = $(this).val();

                $.ajax({
                    type: "GET",
                    url: "{{ route('posts.show', '') }}/" + postId,
                    dataType: "json",
                    success: function(response){
                        $('.error-message').html('');

                        $('#edit-id').val(response.id);
                        $('#edit-blog_name').val(response.blog_name);
                        $('#edit-description').val(response.description);
                        $('#edit-published_at').val(response.published_at);
                    }
                });
            });

            $(document).on('click', '.delete-post', function(e){
                e.preventDefault();

                var postId = $(this).val();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        'Authorization': 'Bearer ' + $('meta[name="api_token"]').attr('content'),
                    }
                });

                $.ajax({
                    type: "DELETE",
                    url: `{{ route('posts.update', '') }}/${postId}`,
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
