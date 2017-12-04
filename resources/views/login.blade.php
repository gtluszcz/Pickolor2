

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
        <h1 class="login-logo"><img src="img/loga.png" alt="logo"><span>What Up To</span></h1>
        <div class="login-wrapper">
            <h2 class="login-title">Log in to your account</h2>
            <form class="login-form" action="engine/login.php" method="POST">
                <input class="login-field" name="username" type="text" placeholder="Login">
                <input class="login-field" name="password" type="password" placeholder="Password">
                <button class="login-button" type="submit">Log In</button>
            </form>
            <div class="register-link">
                <span>New to WhatUpTo? <a href="index.php?action=register">Sign in</a></span>
            </div>
        </div>
    </main>
@endsection