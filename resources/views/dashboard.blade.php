@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container">
    <h3><strong>{{ __('user.title.types.' . $user->user_type) }}'s</strong> Dashboard</h3>
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
            @include('partials.dashboard._stats')
        </div>
    </div>
</div>
@endsection

{{-- @push('scripts')
    <script src="/dashboard.js"></script>
@endpush --}}
