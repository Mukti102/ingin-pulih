<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title></title>
    <title>{{ get_setting('app_name') }}</title>

    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    <link rel="icon" href="{{ Storage::url(get_setting('app_logo')) }}" type="image/x-icon" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/js/app.js'])

    @stack('styles')

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
    @stack('scripts')
</body>

</html>
