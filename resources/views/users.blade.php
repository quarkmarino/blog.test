@extends('layouts.app')

@section('title', 'Users')

@section('content')
<div class="container">
    <h5>Users</h5>
    <div class="row">
        <div class="col-sm-12">
            @include('partials.users._actions_bar')
        </div>
        <div class="col-sm-12">
            @include('partials.users._users_table')
        </div>
    </div>
</div>
@endsection
