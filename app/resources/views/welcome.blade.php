<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>СР-Профиль</title>
        <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('css/bootstrap-vue.min.css')}}">
        <link rel="stylesheet" href="{{asset('css/custom.css')}}">
        <link rel="stylesheet" href="{{asset('css/vue-multiselect.min.css')}}">
    </head>
    <body>
        <div id="app">
            <login></login>
        </div>
        <script src="{{asset('js/vue.min.js')}}"></script>
            <script src="{{asset('js/app.js')}}"></script>
            <script src="{{asset('js/bootstrap-vue.min.js')}}"></script>
    </body>
</html>

