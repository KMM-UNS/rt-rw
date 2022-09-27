<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->

<head>
    <meta charset="utf-8" />
    <title>{{ Auth::user()->name }}</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />

    <!-- ================== BEGIN BASE CSS STYLE ================== -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link href="../assets/plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet" />
    <link href="../assets/plugins/bootstrap/4.1.0/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../assets/plugins/font-awesome/5.0/css/fontawesome-all.min.css" rel="stylesheet" />
    <link href="../assets/plugins/animate/animate.min.css" rel="stylesheet" />
    <link href="../assets/css/default/style.min.css" rel="stylesheet" />
    <link href="../assets/css/default/style-responsive.min.css" rel="stylesheet" />
    <link href="../assets/css/default/theme/default.css" rel="stylesheet" id="theme" />
    <!-- ================== END BASE CSS STYLE ================== -->

    <!-- ================== BEGIN BASE JS ================== -->
    <script src="../assets/plugins/pace/pace.min.js"></script>
    <!-- ================== END BASE JS ================== -->
    @php
        $bodyClass = !empty($boxedLayout) ? 'boxed-layout' : '';
        $bodyClass .= !empty($paceTop) ? 'pace-top ' : '';
        $bodyClass .= !empty($bodyExtraClass) ? $bodyExtraClass . ' ' : '';
        $sidebarHide = !empty($sidebarHide) ? $sidebarHide : '';
        $sidebarTwo = !empty($sidebarTwo) ? $sidebarTwo : '';
        $sidebarSearch = !empty($sidebarSearch) ? $sidebarSearch : '';
        $topMenu = !empty($topMenu) ? $topMenu : '';
        $footer = !empty($footer) ? $footer : '';

        $pageContainerClass = !empty($topMenu) ? 'page-with-top-menu ' : '';
        $pageContainerClass .= !empty($sidebarRight) ? 'page-with-right-sidebar ' : '';
        $pageContainerClass .= !empty($sidebarLight) ? 'page-with-light-sidebar ' : '';
        $pageContainerClass .= !empty($sidebarWide) ? 'page-with-wide-sidebar ' : '';
        $pageContainerClass .= !empty($sidebarHide) ? 'page-without-sidebar ' : '';
        $pageContainerClass .= !empty($sidebarMinified) ? 'page-sidebar-minified ' : '';
        $pageContainerClass .= !empty($sidebarTwo) ? 'page-with-two-sidebar ' : '';
        $pageContainerClass .= !empty($contentFullHeight) ? 'page-content-full-height ' : '';

        $contentClass = !empty($contentFullWidth) || !empty($contentFullHeight) ? 'content-full-width ' : '';
        $contentClass .= !empty($contentInverseMode) ? 'content-inverse-mode ' : '';
    @endphp

    <style>
        img {
            width: 100%;
            height: 500px;
        }
    </style>
</head>

<body class="{{ $bodyClass }}">
    @include('layouts.home')
</body>

</html>
