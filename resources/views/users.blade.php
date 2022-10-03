@extends('layouts.app')

@section('title', 'Users')

@section('content')
<div class="container">
    <h2>Users</h2>
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
