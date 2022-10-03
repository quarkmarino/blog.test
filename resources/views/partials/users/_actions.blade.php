<div class="btn-toolbar justify-content-end" role="toolbar">
    <button type="button" class="btn btn-success" id="create-user">Create User</button>
</div>
<br>

@push('scripts')
    <script>
        $(document).ready(function() {
            $(document).on('click', '#create-user', function(e){
                e.preventDefault();

                $('.error-message').html('');

                $('#user-create-modal').modal('show');
            });
        });
    </script>
@endpush
