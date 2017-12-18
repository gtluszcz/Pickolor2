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
    <script src="../js/allpalettes.js"></script>
@endsection


@section('page_content')

    <div class="controls-wrapper">
        <a href="/palette" class="addpalette">
            <div class="plus">+</div>
            <div class="addpalette-title">Add palette</div>
        </a>
            <div class="order">order by: likes</div>
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

                        @if (auth()->check() and auth()->user()->has_fav_palette($palette))
                            <span class="heart glyphicon glyphicon-heart"></span>
                        @else
                            <span class="heart glyphicon glyphicon-heart-empty"></span>
                        @endif
                    </div>

                </div>
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
                    <div class="likes"><div class="likes-nr">{{$palette->likes}}</div><span class="glyphicon glyphicon-heart likes-icon"></span></div>
                </div>
                </a>
            </div>


        @endforeach

    </div>
    <meta name="_token" content="{!! csrf_token() !!}" />

    {{ $palettes->links('vendor.pagination.default') }}
@endsection