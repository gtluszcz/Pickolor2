@extends('layouts/master')



@section('page_css')
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" crossorigin="anonymous">
    <link type="text/css" href="../css/external/jquery-ui.min.css" rel="Stylesheet" />
    <link type="text/css" href="../css/external/jquery-ui.structure.min.css" rel="Stylesheet" />
    <link type="text/css" href="../css/external/jquery-ui.theme.min.css" rel="Stylesheet" />
    <link type="text/css" rel="stylesheet" href="../css/external/wheelcolorpicker.css">

    <!--my css-->

    <link rel="stylesheet" href="../css/menu.css">
    <link rel="stylesheet" href="../css/allpalettes.css">
@endsection


@section('page_js')

    <script src="../js/external/jquery.js"></script>
    <script src="../js/external/jquery-ui.min.js"></script>
    <script src="../js/external/jquery.ui.touch-punch.min.js"></script>
    <!--my js-->
    <script src="../js/menu.js"></script>
@endsection


@section('page_content')
    @if(auth()->check())
    <div class="palettes-tabs">
        <a href="/palettes/all" class="tab-link
            @if (Request::is('*/all'))
                            active-tab
            @endif">All</a>

            <a href="/palettes/my" class="tab-link
                @if (Request::is('*/my'))
                                active-tab
                @endif">My</a>
            <a href="/palettes/favourite" class="tab-link
                @if (Request::is('*/favourite'))
                                active-tab
                @endif">Favorite</a>
    </div>
    @endif
    <div class="palettes-wrapper">

        @foreach($palettes as $palette)
        <div class="single-palett-wrapper">
            <div class="palette-title"><p>{{$palette->title}}</p><span class="glyphicon glyphicon-heart"></span></div>
            <div class="palette-colors">
                @if ($palette->color1 != null)
                <div class="color" style="background-color: {{$palette->color1}}">
                    <div class="color-title">{{$palette->color1}}</div>
                </div>
                @endif
                @if ($palette->color2 != null)
                    <div class="color" style="background-color: {{$palette->color2}}">
                        <div class="color-title">{{$palette->color2}}</div>
                    </div>
                @endif
                @if ($palette->color3 != null)
                    <div class="color" style="background-color: {{$palette->color3}}">
                        <div class="color-title">{{$palette->color3}}</div>
                    </div>
                @endif
                @if ($palette->color4 != null)
                    <div class="color" style="background-color: {{$palette->color4}}">
                        <div class="color-title">{{$palette->color4}}</div>
                    </div>
                @endif
                @if ($palette->color5 != null)
                    <div class="color" style="background-color: {{$palette->color5}}">
                        <div class="color-title">{{$palette->color5}}</div>
                    </div>
                @endif
            </div>
            <div class="palette-grades">
                <div class="views"><span class="glyphicon glyphicon-eye-open views-icon"></span><div>{{$palette->views}}</div></div>
                <div class="likes"><div>{{$palette->likes}}</div><span class="glyphicon glyphicon-heart likes-icon"></span></div>
            </div>
        </div>

        @endforeach
    </div>
@endsection