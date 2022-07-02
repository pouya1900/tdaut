<!doctype html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="csrf-token" content="{{ csrf_token()  }}">
    <title>{{$setting->title}}</title>
    <link rel="icon" href="{{$setting->icon}}" type="image/gif" sizes="16x16">
    <script src="https://kit.fontawesome.com/ae2e33a4ec.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="js/jquery-3.6.0.min.js"></script>

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.rtl.min.css">

    @yield('style')

</head>
<body>
@yield('content')


<script type="text/javascript" src="js/custom.js"></script>
<script type="text/javascript"
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>

@yield('script')

</body>
</html>