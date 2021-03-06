<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link  rel="stylesheet" href="{{URL::asset('css/app.css') }}">
    <title>Admin</title>
</head>
<body>
<div id="app">
    @yield('header')
    <div class="container-fluid">

        @yield('aditional')

        <div class="row">
            <div class="col-md-12">
                <section>
                    @yield('content')
                </section>
            </div>
        </div>
    </div>
</div>
</body>
<script src="{{URL::asset('js/app.js') }}" defer></script>
</html>