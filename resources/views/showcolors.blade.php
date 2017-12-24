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
    <link rel="stylesheet" href="../css/allcolors.css">
@endsection


@section('page_js')
    <script src="../js/external/colorconversion.js"></script>
    <script src="../js/external/jquery.js"></script>
    <script src="../js/external/jquery-ui.min.js"></script>
    <script src="../js/external/jquery.ui.touch-punch.min.js"></script>
    <!--my js-->
    <script src="../js/menu.js"></script>
    <script src="../js/allcolors.js"></script>
@endsection


@section('page_content')

    <?php

    function addOrUpdateUrlParam($name, $value)
    {
        $params = $_GET;
        unset($params[$name]);
        $params[$name] = $value;
        return '?'.http_build_query($params);

    }
    $likes = addOrUpdateUrlParam("order","likes");
    $newest = addOrUpdateUrlParam("order","newest");
    $oldest = addOrUpdateUrlParam("order","oldest");
    ?>
    <div class="controls-wrapper">
        <a href="/color" class="addpalette">
            <div class="plus">+</div>
            <div class="addpalette-title">Add color</div>
        </a>
        <div class="dropdown show order">
            <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                order by: likes
            </a>

            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <a class="dropdown-item" href="{{$likes}}">likes</a>
                <a class="dropdown-item" href="{{$newest}}">newest</a>
                <a class="dropdown-item" href="{{$oldest}}">oldest</a>
            </div>
        </div>
        <div class="palettes-tabs">
            <a href="/colors/all" class="tab-link
                @if (Request::is('*/all'))
                                active-tab
                @endif">All</a>
                @if(auth()->check())
                <a href="/colors/favourite" class="tab-link
                    @if (Request::is('*/favourite'))
                                    active-tab
                    @endif">Favorite</a>
                @endif
        </div>

    </div>
    <div class="palettes-wrapper">
        @foreach($colors as $color)
            @if($color->hex != "")
            <a href="/color/{{$color->id}}">
                <div class="palette-colors">
                    <div class="color" style="background-color: {{$color->hex}}">
                        <div class="color-id hidden">{{$color->id}}</div>
                        <div class="color-title">{{$color->hex}}</div>
                        @if(auth()->check())
                            @if (auth()->user()->has_fav_color($color))
                                <span class="heart glyphicon glyphicon-heart"></span>
                            @else
                                <span class="heart glyphicon glyphicon-heart-empty"></span>
                            @endif
                        @endif
                    </div>
                </div>
            </a>
            @endif



        @endforeach
        <div class="filler"></div>
        <div class="filler"></div>
        <div class="filler"></div>
        <div class="filler"></div>
        <div class="filler"></div>
        <div class="filler"></div>
        <div class="filler"></div>

    </div>
    <meta name="_token" content="{!! csrf_token() !!}" />

    {{ $colors->links('vendor.pagination.default') }}
@endsection