@extends('layouts/form')



@section('page_css')
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" crossorigin="anonymous">
    <link type="text/css" href="css/external/jquery-ui.min.css" rel="Stylesheet" />
    <link type="text/css" href="css/external/jquery-ui.structure.min.css" rel="Stylesheet" />
    <link type="text/css" href="css/external/jquery-ui.theme.min.css" rel="Stylesheet" />

    <!--my css-->
    <link rel="stylesheet" href="css/menu.css">
    <link rel="stylesheet" href="css/login.css">
@endsection


@section('page_js')
    <script src="js/external/jquery.js"></script>
    <script src="js/external/jquery-ui.min.js"></script>
    <script src="js/external/jquery.ui.touch-punch.min.js"></script>
@endsection


@section('page_content')
    <main class="nonlogin-wrapper">
        <h1 class="login-logo"><a href="/">Pickolor</a></h1>
        <div class="login-wrapper">
            <h2 class="login-title">Create new account</h2>
            <form class="login-form" action="/register" method="POST">

                {!! csrf_field() !!}
                <input class="login-field" name="name" type="text" placeholder="Username">
                <input class="login-field" name="email" type="email" placeholder="E-mail">
                <input class="login-field" type="password" name="password" placeholder="Password">
                <input class="login-field" type="password" name="password_confirmation" placeholder="Retype password">
                <button class="login-button" type="submit">Sign up!</button>
            </form>
            @include("assets/error")
            <div class="register-link">
                <span>Already own an account? <a href="/login">Log In!</a></span>
            </div>
        </div>
    </main>
@endsection



