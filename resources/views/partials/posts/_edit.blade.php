<!-- Modal -->
<div class="modal fade" id="post-edit-modal" tabindex="-1" aria-labelledby="post-edit-modal-label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="post-edit-modal-label">Edit Post Details</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form>
                    <input type="hidden" id="edit-id">
                    <div class="form-group row">
                        <label for="blog_name" class="col-sm-3 col-form-label">{{ __('post.title.blog_name') }}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control post-edit-field" name="blog_name" id="edit-blog_name">
                            <span class="text-danger error-message blog_name-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="description" class="col-sm-3 col-form-label">{{ __('post.title.description') }}</label>
                        <div class="col-sm-9">
                            <textarea class="form-control post-edit-field" name="description" id="edit-description" rows="3"></textarea>
                            <span class="text-danger error-message description-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="published_at" class="col-sm-3 col-form-label">{{ __('post.title.published_at') }}</label>
                        <div class="col-sm-9">
                            <input type="date" class="form-control post-edit-field" name="edit-published_at" id="edit-published_at">
                            <span class="text-danger error-message published_at-errors"></span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="update-post-details">Update Post Details</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(document).ready(function() {
            function updatePostDetails() {
                var postId = $('#edit-id').val();

                var postData = {
                    'blog_name': $('#edit-blog_name').val(),
                    'description': $('#edit-description').val(),
                    'published_at': $('#edit-published_at').val(),
                };

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        'Authorization': 'Bearer ' + $('meta[name="api_token"]').attr('content'),
                    }
                });

                $.ajax({
                    type: "PUT",
                    url: `{{ route('posts.update', '') }}/${postId}`,
                    data: postData,
                    dataType: "json",
                })
                .done(function(response) {
                    $('.error-message').html('');

                    $.ajax({
                        type: "GET",
                        url: `{{ route('posts.show', '') }}/${postId}`,
                        contentType:"text/html; charset=UTF-8",
                        success: function(response) {
                            $(`#post-${postId}`).replaceWith(response);
                            $('#post-edit-modal').modal('hide');
                        }
                    });

                    $('#page-toast .toast-body').html('Post updated sucessfully.');
                })
                .fail(function(jqXHR){
                    if (jqXHR.status == 403) {
                        $('#page-toast .toast-body').html(jqXHR.responseJSON.message);
                        $('#page-toast').toast('show');
                    }
                    if (jqXHR.status == 422) {
                        $.each(jqXHR.responseJSON.errors, function(key, errors){
                            $(`#post-edit-modal .${key}-errors`).html(errors[0]);
                        });
                    }
                });
            }

            $(document).on('click', '#update-post-details', function(e){
                e.preventDefault();

                updatePostDetails();
            });

            $('.post-edit-field').on('keypress', function(e){
                if(e.which == 13 && $(this).attr('id') != 'edit-description') {
                    updatePostDetails();
                }
            });
        });
    </script>
@endpush
