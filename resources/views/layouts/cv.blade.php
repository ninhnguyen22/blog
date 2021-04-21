<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> N-Blog | {{ $_data['_title'] }}</title>

    <link rel="shortcut icon" href="{{ $_data['_root_asset'] }}/assets/images/fav.jpg">
    <link rel="stylesheet" href="{{ $_data['_root_asset'] }}/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ $_data['_root_asset'] }}/assets/css/fontawsom-all.min.css">
    <link rel="stylesheet" type="text/css" href="{{ $_data['_root_asset'] }}/assets/css/style.css"/>
</head>

<body>
<div class="container-fluid overcover">
    @yield('content')
</div>
</body>

<script src="{{ $_data['_root_asset'] }}/assets/js/jquery-3.2.1.min.js"></script>
<script src="{{ $_data['_root_asset'] }}/assets/js/popper.min.js"></script>
<script src="{{ $_data['_root_asset'] }}/assets/js/bootstrap.min.js"></script>
<script src="{{ $_data['_root_asset'] }}/assets/js/script.js"></script>
</html>
