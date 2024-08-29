<!DOCTYPE html><!--
* CoreUI - Free Bootstrap Admin Template
* @version v4.2.2
* @link https://coreui.io/product/free-bootstrap-admin-template/
* Copyright (c) 2023 creativeLabs Łukasz Holeczek
* Licensed under MIT (https://github.com/coreui/coreui-free-bootstrap-admin-template/blob/main/LICENSE)
--><!-- Breadcrumb-->
<html lang="en">
<head>
    <base href="/">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="CoreUI - Open Source Bootstrap Admin Template">
    <meta name="author" content="Łukasz Holeczek">
    <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,jQuery,CSS,HTML,RWD,Dashboard">
    <title>AI Math CMS</title>
    <link rel="apple-touch-icon" sizes="57x57" href="/modules/coreui/assets/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/modules/coreui/assets/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/modules/coreui/assets/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/modules/coreui/assets/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/modules/coreui/assets/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/modules/coreui/assets/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/modules/coreui/assets/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/modules/coreui/assets/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/modules/coreui/assets/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="/modules/coreui/assets/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/modules/coreui/assets/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/modules/coreui/assets/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/modules/coreui/assets/favicon/favicon-16x16.png">
    <link rel="manifest" href="/modules/coreui/assets/favicon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="assets/favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <!-- Vendors styles-->
    <link rel="stylesheet" href="/modules/coreui/vendors/simplebar/css/simplebar.css">
    <!-- Main styles for this application-->
    <link href="/modules/coreui/css/style.css" rel="stylesheet">
{{--    <!-- We use those styles to show code examples, you should remove them in your application.-->--}}
    <link href="/modules/coreui/css/examples.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/gh/lelinh014756/fui-toast-js@master/assets/css/toast@1.0.1/fuiToast.min.css">
    @stack('style')
</head>
<body>
@if(Route::currentRouteName()=='login')
    @yield('content')
@else
    <x-coreui::sidebar></x-coreui::sidebar>
    <div class="wrapper d-flex flex-column min-vh-100 bg-light">
        <x-coreui::header></x-coreui::header>
        @yield('content')
        <x-coreui::footer></x-coreui::footer>
    </div>
@endif
<div id="fui-toast"></div>
<script src="/modules/coreui/vendors/@coreui/coreui/js/coreui.bundle.min.js"></script>
<script src="/modules/coreui/vendors/simplebar/js/simplebar.min.js"></script>
<script src="/modules/coreui/sweetalert2.all.min.js"></script>
<script   src="https://code.jquery.com/jquery-3.1.1.min.js"   integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="   crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/gh/lelinh014756/fui-toast-js@master/assets/js/toast@1.0.1/fuiToast.min.js"></script>

@stack('scripts')
{{--@vite(\Nwidart\Modules\Module::getAssets())--}}
</body>
</html>
