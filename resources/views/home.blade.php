@extends('layouts/master')



@section('page_css')
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" crossorigin="anonymous">
    <link type="text/css" href="css/external/jquery-ui.min.css" rel="Stylesheet" />
    <link type="text/css" href="css/external/jquery-ui.structure.min.css" rel="Stylesheet" />
    <link type="text/css" href="css/external/jquery-ui.theme.min.css" rel="Stylesheet" />
    <link type="text/css" rel="stylesheet" href="css/external/wheelcolorpicker.css">

    <!--my css-->
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/menu.css">
    <link rel="stylesheet" href="css/home.css">
    <link id="css_other" rel="stylesheet" href="">
@endsection


@section('page_js')
    <script src="js/external/colorconversion.js"></script>
    <script src="js/external/jquery.js"></script>
    <script src="js/external/jquery-ui.min.js"></script>
    <script src="js/external/jquery.ui.touch-punch.min.js"></script>
    <script type="text/javascript" src="js/external/jquery.wheelcolorpicker.js"></script>

    <!--my js-->
    <script src="js/menu.js"></script>
@endsection


@section('page_content')

    <div class="addpalette">
        <a href="/palette" class="addpalette-title left">Add palette</a>
        <div class="plus">+</div>
        <a href="/color" class="addpalette-title right">Add color</a>
    </div>
    <div class="start">
        <div class="welcome">
            <div class="welcome-title">Color picker for You!</div>
            <p class="welcome-text">Pickolor is a highly intuitive color picker designed especialy for developers. Discover it's magical powers and sign up now...</p>
        </div>
        @if (!Auth::check())
        <div class="login-form">
            <h2 class="login-title">Create new account</h2>
            <form class="" action="/register" method="POST">
                {!! csrf_field() !!}
                <input class="login-field" name="name" type="text" placeholder="Username">
                <input class="login-field" name="email" type="email" placeholder="E-mail">
                <input class="login-field" type="password" name="password" placeholder="Password">
                <input class="login-field" type="password" name="password_confirmation" placeholder="Retype password">
                <button class="login-button" type="submit">Sign up!</button>
            </form>
            @include("assets/error")
        </div>
        @endif
    </div>
@endsection

