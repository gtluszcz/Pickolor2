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
    <script src="../js/external/colorconversion.js"></script>
    <script src="../js/external/jquery.js"></script>
    <script src="../js/external/jquery-ui.min.js"></script>
    <script src="../js/external/jquery.ui.touch-punch.min.js"></script>
    <!--my js-->
    <script src="../js/menu.js"></script>
    <script src="../js/allpalettes.js"></script>
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
    $views = addOrUpdateUrlParam("order","views");
    ?>
    <div class="controls-wrapper">
        <a href="/palette" class="addpalette">
            <div class="plus">+</div>
            <div class="addpalette-title">Add palette</div>
        </a>
        <div class="dropdown show order">
            <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                order by: likes
            </a>

            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <a class="dropdown-item" href="{{$likes}}">likes</a>
                <a class="dropdown-item" href="{{$newest}}">newest</a>
                <a class="dropdown-item" href="{{$oldest}}">oldest</a>
                <a class="dropdown-item" href="{{$views}}">views</a>
            </div>
        </div>
            <div class="palettes-tabs">
                <a href="/palettes/all" class="tab-link
                    @if (Request::is('*/all'))
                                    active-tab
                    @endif">All</a>
                    @if(auth()->check())
                    <a href="/palettes/my" class="tab-link
                        @if (Request::is('*/my'))
                                        active-tab
                        @endif">My</a>
                    <a href="/palettes/favourite" class="tab-link
                        @if (Request::is('*/favourite'))
                                        active-tab
                        @endif">Favorite</a>
                    @endif
            </div>

    </div>
    <div class="palettes-wrapper">

        @foreach($palettes as $palette)
            <div class="single-palett-wrapper">
                <a href="/palette/{{$palette->id}}">
                <div class="palette-title">

                    <p>{{$palette->title}}</p>

                    <input class="hidden id" value="{{$palette->id}}">

                    <div class="palette-title">

                        @if (auth()->check() and $palette->createdby->id == auth()->id())
                            <span class="trash glyphicon glyphicon-trash"></span>
                        @endif

                        @if(auth()->check())
                            @if (auth()->user()->has_fav_palette($palette))
                                <span class="heart glyphicon glyphicon-heart"></span>
                            @else
                                <span class="heart glyphicon glyphicon-heart-empty"></span>
                            @endif
                        @endif
                    </div>

                </div>
                <div class="palette-colors">
                    @if ($palette->color1->hex != null)
                    <div class="color" style="background-color: {{$palette->color1->hex}}">
                        <div class="color-title">{{$palette->color1->hex}}</div>
                    </div>
                    @endif
                    @if ($palette->color2->hex != null)
                        <div class="color" style="background-color: {{$palette->color2->hex}}">
                            <div class="color-title">{{$palette->color2->hex}}</div>
                        </div>
                    @endif
                    @if ($palette->color3->hex != null)
                        <div class="color" style="background-color: {{$palette->color3->hex}}">
                            <div class="color-title">{{$palette->color3->hex}}</div>
                        </div>
                    @endif
                    @if ($palette->color4->hex != null)
                        <div class="color" style="background-color: {{$palette->color4->hex}}">
                            <div class="color-title">{{$palette->color4->hex}}</div>
                        </div>
                    @endif
                    @if ($palette->color5->hex != null)
                        <div class="color" style="background-color: {{$palette->color5->hex}}">
                            <div class="color-title">{{$palette->color5->hex}}</div>
                        </div>
                    @endif
                </div>
                <div class="palette-grades">
                    <div class="views"><span class="glyphicon glyphicon-eye-open views-icon"></span><div>{{$palette->views}}</div></div>
                    <div class="likes"><div class="likes-nr">{{$palette->likes}}</div><span class="glyphicon glyphicon-heart likes-icon"></span></div>
                </div>
                </a>
            </div>


        @endforeach
        <div class="filler"></div>
        <div class="filler"></div>
        <div class="filler"></div>
        <div class="filler"></div>

    </div>
    <meta name="_token" content="{!! csrf_token() !!}" />

    {{ $palettes->links('vendor.pagination.default') }}
@endsection