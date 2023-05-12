<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <title>Laravel Brodie</title>
    {{-- {{ $slot }} --}}
    <style>
        .dropdown select {
            width: 200px;
            padding: 10px;
            font-size: 16px;
            border: none;
            background-color: #f2f2f2;
        }

        .dropdown select:focus {
            outline: none;
        }

        .dropdown option:first-child {
            color: gray;
        }

        .dropdown option:not(:first-child):hover {
            background-color: #ddd;
        }

    </style>
</head>
<body>
    <x-navbar.navbar></x-navbar.navbar>
    <div id="app">
       <example-component></example-component>
    </div>
    {{ $slot }}
    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>