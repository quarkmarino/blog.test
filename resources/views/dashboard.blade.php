@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container">
    <h3><strong>{{ __('user.title.types.' . $user->user_type) }}'s</strong> Dashboard Page</h3>
    @if (session('status'))
        <div class="row justify-content-center">
            <div class="col-md-12 alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        </div>
    @endif
    <div class="row">
        <div class="col-sm-6 col-md-5">
            @include('partials.dashboard._profile')
        </div>
        <div class="col-sm-8 col-md-7">
            @includeIf('partials.dashboard.stats._' . $user->user_type)
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
