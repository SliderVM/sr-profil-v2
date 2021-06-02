<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>СР-Профиль</title>
        {{-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> --}}
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/bootstrap-vue.min.css') }}">
        {{-- <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}"> --}}
        {{-- <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}"> --}}
        <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
        <link rel="stylesheet" href="{{ asset('css/vue-multiselect.min.css') }}">
    </head>

<body>
    <div id="app">
        <v-header></v-header>
        <router-view></router-view>
    </div>

    <script src="{{ asset('js/vue.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-vue.min.js') }}"></script>
    {{-- <script src="{{ asset('js/popper.min.js') }}"></script> --}}
    {{-- <script type="text/javascript" src="{{ asset('js/pickmeup.js') }}"></script> --}}
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
