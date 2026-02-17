<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title></title>
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    <link rel="icon" href="/assets/img/kaiadmin/favicon.ico" type="image/x-icon" />

    @vite(['resources/js/app.js'])
    @include('includes.dashboard.style')

</head>

<body>
    <div class="wrapper">
        @include('partials.dashboard.sidebar')
        <div class="main-panel">
            @include('partials.dashboard.header')
            <div class="container">
                <div class="page-inner">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>
    @include('sweetalert::alert')
    @include('includes.dashboard.script')
</body>

</html>
