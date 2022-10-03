<div class="btn-toolbar justify-content-end" role="toolbar">
    <button type="button" class="btn btn-success" id="create-post">Create Post</button>
</div>
<br>

@push('scripts')
    <script>
        $(document).ready(function() {
            $(document).on('click', '#create-post', function(e){
                e.preventDefault();

                $('.error-message').html('');

                $('#post-create-modal').modal('show');
            });
        });
    </script>
@endpush
