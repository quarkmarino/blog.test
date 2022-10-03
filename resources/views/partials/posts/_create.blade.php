<!-- Modal -->
<div class="modal fade" id="post-create-modal" tabindex="-1" aria-labelledby="post-create-modal-label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="post-create-modal-label">Create New Post</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group row">
                        <label for="blog_name" class="col-sm-3 col-form-label">{{ __('post.title.blog_name') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control post-field" name="blog_name" id="post-blog_name">
                            <span class="text-danger error-message blog_name-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="description" class="col-sm-3 col-form-label">{{ __('post.title.description') }}</label>
                        <div class="col-sm-9">
                            <textarea class="form-control post-field" name="description" id="post-description" rows="3"></textarea>
                            <span class="text-danger error-message description-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="published_at" class="col-sm-3 col-form-label">{{ __('post.title.published_at') }}</label>
                        <div class="col-sm-9">
                            <input type="date" class="form-control post-field" name="published_at" id="post-published_at">
                            <span class="text-danger error-message published_at-errors"></span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="store-post-details">Save Post Details</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(document).ready(function() {
            function storePostDetails() {
                var postData = {
                    'blog_name': $('#post-blog_name').val(),
                    'description': $('#post-description').val(),
                    'published_at': $('#post-published_at').val(),
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
                    url: '{{ route('posts.store') }}',
                    data: postData,
                    dataType: "json",
                })
                .done(function(response) {
                    window.location.replace(`{{ route('blogs.page') }}?search=id:${response.id}`);
                })
                .fail(function(jqXHR){
                    if (jqXHR.status == 403) {
                        $('#page-toast .toast-body').html(jqXHR.responseJSON.message);
                        $('#page-toast').toast('show');
                    }
                    if (jqXHR.status == 422) {
                        $.each(jqXHR.responseJSON.errors, function(key, errors){
                            $(`#post-create-modal .${key}-errors`).html(errors[0]);
                        });
                    }
                });
            }

            $(document).on('click', '#store-post-details', function(e){
                e.preventDefault();

                storePostDetails();
            });

            $('.post-field').on('keypress', function(e){
                if(e.which == 13) {
                    storePostDetails();
                }
            });
        });
    </script>
@endpush
