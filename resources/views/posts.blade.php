@extends('layouts.app')

@section('title', 'Posts')

@section('content')
<div class="container">
    <h2>Posts Page</h2>
    <div class="row">
        <div class="col-sm-12">
            @include('partials.posts._actions')
        </div>
        <div class="col-sm-12">
            @include('partials.posts._table')
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.toast').toast({delay: 3500});
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@endpush
