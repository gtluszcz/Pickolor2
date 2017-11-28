@extends('layouts/master')



@section('page_css')
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" crossorigin="anonymous">
    <link type="text/css" href="css/jquery-ui.min.css" rel="Stylesheet" />
    <link type="text/css" href="css/jquery-ui.structure.min.css" rel="Stylesheet" />
    <link type="text/css" href="css/jquery-ui.theme.min.css" rel="Stylesheet" />
    <link type="text/css" rel="stylesheet" href="css/wheelcolorpicker.css">

    <!--my css-->
    <link rel="stylesheet" href="css/menu.css">
    <link rel="stylesheet" href="css/home.css">
@endsection


@section('page_js')
    <script src="js/colorconversion.js"></script>
    <script src="js/jquery.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/jquery.ui.touch-punch.min.js"></script>
    <script type="text/javascript" src="js/jquery.wheelcolorpicker.js"></script>

    <!--my js-->
    <script src="js/menu.js"></script>
@endsection


@section('page_content')
    <div class="start">
        <div class="welcome">
            <div class="welcome-title">Color picker for You!</div>
            <p class="welcome-text">Pickolor is a higly intuitive color picker designed especialy for developers. Discover it's magical powers and sign up now...</p>
        </div>
        <div class="login-form"></div>
    </div>
@endsection

