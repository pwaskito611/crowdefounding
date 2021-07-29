<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ether4Charity | Admin</title>
    @include('includes.admin.style')
</head>
<body>
    <div class="container-scroller">
        @include('includes.admin.navbar')
        <div class="container-fluid page-body-wrapper">
            @include('includes.admin.sidebar')
           <div class="main-panel">
               @yield('content')
               @include('includes.admin.footer')
           </div>
        </div>
    </div>
    @include('includes.admin.js')
</body>
</html>