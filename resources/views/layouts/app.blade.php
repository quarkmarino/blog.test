<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta meta name="api_token" content="{{ (Auth::user()) ? Auth::user()->api_token : '' }}">

    <title>
        {{ config('app.name', 'Laravel') }} - @yield('title')
    </title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" {{-- defer --}}></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        @include('partials.app._navbar')

        <main class="py-4">
            @yield('content')
            <div aria-live="polite" aria-atomic="true" class="d-flex justify-content-end align-items-center">
                <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" id="page-toast">
                    <div class="toast-header">
                    <strong class="mr-auto">Users Page Says</strong>
                    <small class="text-muted">just now</small>
                    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="toast-body"></div>
                </div>
            </div>
        </main>
    </div>

    <!-- Scripts -->
    @stack('scripts')

</body>
</html>
