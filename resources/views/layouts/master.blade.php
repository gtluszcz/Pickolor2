<!doctype html>
<html lang="en">
<head>
    <title>Pickolor</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    @yield('page_css')

    <link id="css_other" rel="stylesheet" href="">

    @yield('page_js')


</head>
<body id="body">
    @include('../assets/sidebar')
    @include('../assets/chat')


    <div class="container-fluid">

        <div class="container">


            @include('../assets/navbar')


            @yield('page_content')

        </div>

    </div>
    <meta name="_token" content="{!! csrf_token() !!}" />

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
</body>
</html>
