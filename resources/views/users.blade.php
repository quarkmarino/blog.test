@extends('layouts.app')

@section('title', 'Users')

@section('content')
<div class="container">
    <h2>Users Page</h2>
    <div class="row">
        <div class="col-sm-12">
            @include('partials.users._actions')
        </div>
        <div class="col-sm-12">
            @include('partials.users._table')
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
