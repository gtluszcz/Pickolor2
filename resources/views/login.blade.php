

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
            <h2 class="login-title">Log in to your account</h2>
            <form class="login-form" action="/login" method="POST">
                {!! csrf_field() !!}
                <input class="login-field" name="name" type="text" placeholder="Login">
                <input class="login-field" name="password" type="password" placeholder="Password">
                <button class="login-button" type="submit">Log In</button>
            </form>
            @include("assets/error")
            <div class="register-link">
                <span>Don't have an acount?<a href="/register"> Sign up</a></span>
            </div>
        </div>
    </main>
@endsection