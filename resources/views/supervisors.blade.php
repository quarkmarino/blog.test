@extends('layouts.app')

@section('title', 'Users')

@section('content')
<div class="container">
    <h2>Supervisors Page</h2>
    <div class="row">
        <div class="col-sm-12">
            @include('partials.supervisors._table')
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
