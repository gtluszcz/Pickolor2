@extends('layouts/master')

@section('page_css')

    <!-- external CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" crossorigin="anonymous">
    <link type="text/css" href="../css/external/jquery-ui.min.css" rel="Stylesheet" />
    <link type="text/css" href="../css/external/jquery-ui.structure.min.css" rel="Stylesheet" />
    <link type="text/css" href="../css/external/jquery-ui.theme.min.css" rel="Stylesheet" />
    <link type="text/css" rel="stylesheet" href="../css/external/wheelcolorpicker.css">

    <!--my css-->
    <link rel="stylesheet" href="../css/menu.css">
    <link rel="stylesheet" href="../css/palette.css">
    <link rel="stylesheet" href="../css/color.css">

    <link href="https://fonts.googleapis.com/css?family=Bungee+Shade|Faster+One|Permanent+Marker|Rye" rel="stylesheet">

@endsection



@section('page_js')

    <!-- external JS -->
    <script src="../js/external/colorconversion.js"></script>
    <script src="../js/external/jquery.js"></script>
    <script src="../js/external/jquery-ui.min.js"></script>
    <script src="../js/external/jquery.ui.touch-punch.min.js"></script>
    <script type="text/javascript" src="../js/external/jquery.wheelcolorpicker.js"></script>
    <script type='text/javascript' src='../js/external/tinycolor.js'></script>

    <!--my js-->
    <script src="../js/menu.js"></script>
    <script src="../js/color.js"></script>




@endsection


@section('page_content')


                <form name="paletaForm" method="post" action="/color">


                    {!! csrf_field() !!}
                    <input name="new" type="text" value="{{$new}}" class="hidden">
                    <!--Title-->
                    <!--palette controlling buttons-->
                    <div class="controls">
                        <div class="k"></div>
                        <div style="max-width: 130px;">
                            @if(auth()->check())
                                <span class="save sort-hidden glyphicon glyphicon-floppy-saved" type="submit"></span>
                            @else
                                <span class="sort-hidden glyphicon glyphicon-floppy-saved cantAddNewColor" type="submit"><span class="login-to-save">Sign in to save your colors</span></span>
                            @endif
                        </div>
                        <div class="edit"><span class="glyphicon glyphicon-pencil"></span><div>Edit</div></div>
                    </div>



                    <div class="paleta">

                        <!--#1 COLOR-->
                        @if(!$new)
                                <div class="color">
                                    <div class="color-bar">
                                        <input id="colorid" class="hidden" value="{{$color->id}}" readonly>
                                        <input class="color-title" name="color1" type="text" maxlength="7"  value="{{$color->hex}}" pattern="^#[0-9a-fA-F]{6}$" spellcheck="false"  readonly>
                                        <div class="icons">
                                            @if(auth()->check())
                                                @if (auth()->user()->has_fav_color($color))
                                                    <span class="glyphicon glyphicon-heart likeheart"></span>
                                                @else
                                                    <span class="glyphicon glyphicon-heart-empty likeheart"></span>
                                                @endif
                                            @else
                                                <span class="glyphicon glyphicon-heart cantAddNewColor "></span><span class="login-to-save">Sign in to save your palettes</span></span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="color-content col-lg-12">
                                        <div class="suwaki col-lg-7 col-md-7 col-sm-7 col-xs-12">
                                            <div class="tabs-nav">
                                                <a target="" class="tabs-link active-tab">RGB</a>
                                                <a target="" class="tabs-link">HSL</a>
                                            </div>
                                            <div id="" class="link">
                                                <div class="property">
                                                    R:   <div class="rgb-r value">255</div>
                                                    <div class="rgb-r-slider rgb-slider slider">
                                                        <div class="slider-handle-wraper"><span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default" style="left: 0%;"></span></div>
                                                    </div>
                                                </div>
                                                <div class="property">
                                                    G:  <div class="rgb-g value">255</div>
                                                    <div class="rgb-g-slider rgb-slider slider">
                                                        <div class="slider-handle-wraper"><span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default" style="left: 0%;"></span></div>

                                                    </div>
                                                </div>
                                                <div class="property">
                                                    B: <div class="rgb-b value">255</div>
                                                    <div class="rgb-b-slider rgb-slider slider">
                                                        <div class="slider-handle-wraper"><span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default" style="left: 0%;"></span></div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div id="" class="link hidden">
                                                <div class="property">
                                                    H:<div class="hsl-h value">360</div>
                                                    <div class="hsl-h-slider slider hue-slider">
                                                        <div class="slider-handle-wraper"><span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default" style="left: 0%;"></span></div>

                                                    </div>
                                                </div>
                                                <div class="property">
                                                    S:<div class="hsl-s value">100%</div>
                                                    <div class="hsl-s-slider slider percent-slider">
                                                        <div class="slider-handle-wraper"><span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default" style="left: 0%;"></span></div>

                                                    </div>
                                                </div>
                                                <div class="property">
                                                    L:<div class="hsl-l value">100%</div>
                                                    <div class="hsl-l-slider slider percent-slider">
                                                        <div class="slider-handle-wraper"><span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default" style="left: 0%;"></span></div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="picker col-lg-5 col-md-5 col-sm-5 col-xs-12 disabled">
                                            <input class="wheel-picker disabled">
                                        </div>

                                        <div class="color-more">
                                            <div class="more-colors-title"><h3>analogus colors</h3></div>
                                            <div id="analoguscolors" class="color-list">
                                                <div class="more-color col-lg-1 col-md-1 col-sm-2 col-xs-3">#333333</div>
                                                <div class="more-color col-lg-1 col-md-1 col-sm-2 col-xs-3">#333333</div>
                                                <div class="more-color col-lg-1 col-md-1 col-sm-2 col-xs-3">#333333</div>
                                                <div class="more-color col-lg-1 col-md-1 col-sm-2 col-xs-3">#333333</div>
                                                <div class="more-color col-lg-1 col-md-1 col-sm-2 col-xs-3">#333333</div>
                                                <div class="actual more-color col-lg-1 col-md-1 col-sm-2 col-xs-3">#333333</div>
                                                <div class="more-color col-lg-1 col-md-1 col-sm-2 col-xs-3">#333333</div>
                                                <div class="more-color col-lg-1 col-md-1 col-sm-2 col-xs-3">#333333</div>
                                                <div class="more-color col-lg-1 col-md-1 col-sm-2 col-xs-3">#333333</div>
                                                <div class="more-color col-lg-1 col-md-1 col-sm-2 col-xs-3">#333333</div>
                                                <div class="more-color col-lg-1 col-md-1 col-sm-2 col-xs-3">#333333</div>
                                                <div class="more-color col-lg-1 col-md-1 col-sm-2 col-xs-3">#333333</div>
                                            </div>

                                            <div class="more-colors-title"><h3>monochromatic colors</h3></div>
                                            <div id="monochromaticcolors" class="color-list">
                                                <div class="more-color col-lg-1 col-md-1 col-sm-2 col-xs-3">#333333</div>
                                                <div class="more-color col-lg-1 col-md-1 col-sm-2 col-xs-3">#333333</div>
                                                <div class="more-color col-lg-1 col-md-1 col-sm-2 col-xs-3">#333333</div>
                                                <div class="more-color col-lg-1 col-md-1 col-sm-2 col-xs-3">#333333</div>
                                                <div class="more-color col-lg-1 col-md-1 col-sm-2 col-xs-3">#333333</div>
                                                <div class="actual more-color col-lg-1 col-md-1 col-sm-2 col-xs-3">#333333</div>
                                                <div class="more-color col-lg-1 col-md-1 col-sm-2 col-xs-3">#333333</div>
                                                <div class="more-color col-lg-1 col-md-1 col-sm-2 col-xs-3">#333333</div>
                                                <div class="more-color col-lg-1 col-md-1 col-sm-2 col-xs-3">#333333</div>
                                                <div class="more-color col-lg-1 col-md-1 col-sm-2 col-xs-3">#333333</div>
                                                <div class="more-color col-lg-1 col-md-1 col-sm-2 col-xs-3">#333333</div>
                                                <div class="more-color col-lg-1 col-md-1 col-sm-2 col-xs-3">#333333</div>
                                            </div>

                                            <div class="more-colors-title"><h3>complementary color</h3></div>
                                            <div class="color-list">
                                                <div class="actual more-color col-lg-6 col-md-6 col-sm-6 col-xs-6">#333333</div>
                                                <div id="complementary" class="more-color col-lg-6 col-md-6 col-sm-6 col-xs-6">#333333</div>
                                            </div>

                                            <div class="more-colors-title"><h3>triadic colors</h3></div>
                                            <div id="triadiccolors" class="color-list">
                                                <div class="more-color col-lg-1 col-md-1 col-sm-2 col-xs-3">#333333</div>
                                                <div class="more-color col-lg-1 col-md-1 col-sm-2 col-xs-3">#333333</div>
                                                <div class="more-color col-lg-1 col-md-1 col-sm-2 col-xs-3">#333333</div>
                                                <div class="more-color col-lg-1 col-md-1 col-sm-2 col-xs-3">#333333</div>
                                                <div class="more-color col-lg-1 col-md-1 col-sm-2 col-xs-3">#333333</div>
                                                <div class="actual more-color col-lg-1 col-md-1 col-sm-2 col-xs-3">#333333</div>
                                                <div class="more-color col-lg-1 col-md-1 col-sm-2 col-xs-3">#333333</div>
                                                <div class="more-color col-lg-1 col-md-1 col-sm-2 col-xs-3">#333333</div>
                                                <div class="more-color col-lg-1 col-md-1 col-sm-2 col-xs-3">#333333</div>
                                                <div class="more-color col-lg-1 col-md-1 col-sm-2 col-xs-3">#333333</div>
                                                <div class="more-color col-lg-1 col-md-1 col-sm-2 col-xs-3">#333333</div>
                                                <div class="more-color col-lg-1 col-md-1 col-sm-2 col-xs-3">#333333</div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                        @else
                            <div class="color">
                                <div class="color-bar">
                                    <input class="color-title" name="color1" type="text" maxlength="7"  value="#00BFFF" pattern="^#[0-9a-fA-F]{6}$" spellcheck="false"  readonly>
                                    <div class="icons">
                                        <span class="glyphicon glyphicon-heart likeheart"></span>
                                        <span class="glyphicon glyphicon-trash sort-hidden"></span>
                                        <span class="glyphicon glyphicon-sort sort-hidden"></span>
                                    </div>
                                </div>

                                <div class="color-content col-lg-12">
                                    <div class="suwaki col-lg-7 col-md-7 col-sm-12 col-xs-12">
                                        <div class="tabs-nav">
                                            <a target="" class="tabs-link active-tab">RGB</a>
                                            <a target="" class="tabs-link">HSL</a>
                                        </div>
                                        <div id="" class="link">
                                            <div class="property">
                                                R:   <div class="rgb-r value">255</div>
                                                <div class="rgb-r-slider rgb-slider slider">
                                                    <div class="slider-handle-wraper"><span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default" style="left: 0%;"></span></div>
                                                </div>
                                            </div>
                                            <div class="property">
                                                G:  <div class="rgb-g value">255</div>
                                                <div class="rgb-g-slider rgb-slider slider">
                                                    <div class="slider-handle-wraper"><span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default" style="left: 0%;"></span></div>

                                                </div>
                                            </div>
                                            <div class="property">
                                                B: <div class="rgb-b value">255</div>
                                                <div class="rgb-b-slider rgb-slider slider">
                                                    <div class="slider-handle-wraper"><span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default" style="left: 0%;"></span></div>

                                                </div>
                                            </div>
                                        </div>
                                        <div id="" class="link hidden">
                                            <div class="property">
                                                H:<div class="hsl-h value">360</div>
                                                <div class="hsl-h-slider slider hue-slider">
                                                    <div class="slider-handle-wraper"><span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default" style="left: 0%;"></span></div>

                                                </div>
                                            </div>
                                            <div class="property">
                                                S:<div class="hsl-s value">100%</div>
                                                <div class="hsl-s-slider slider percent-slider">
                                                    <div class="slider-handle-wraper"><span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default" style="left: 0%;"></span></div>

                                                </div>
                                            </div>
                                            <div class="property">
                                                L:<div class="hsl-l value">100%</div>
                                                <div class="hsl-l-slider slider percent-slider">
                                                    <div class="slider-handle-wraper"><span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default" style="left: 0%;"></span></div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="picker col-lg-5 col-md-5 col-sm-12 col-xs-12 disabled">
                                        <input class="wheel-picker disabled">
                                    </div>

                                </div>
                            </div>

                        @endif




                    </div>
                </form>

                <!--below palette controlling buttons-->
                <div class="controls">
                    <div class="views"></div>
                    <div class="likes"><span class="glyphicon glyphicon-heart "></span><div id="likesamount">@if(!$new){{$color->likes}} @else 0 @endif</div></div>
                </div>

                <div class="showoff"  @if(!$new) style="color: {{$color->hex}};" @else style="color: #00BFFF;" @endif>

                    {{--<svg id="svg-head" style=" @if(!$new) fill: {{$color->hex}}; @else fill: #00BFFF; @endif " xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32">--}}
                        {{--<path style="text-indent:0;text-align:start;line-height:normal;text-transform:none;block-progression:tb;-inkscape-font-specification:Sans" d="M 16.0625 2 C 12.394187 2 9.3789679 4.1257791 7.3125 6.46875 C 6.279266 7.6402355 5.4713599 8.8705547 4.90625 10 C 4.3411401 11.129445 4 12.092434 4 13 C 4 14.307552 4.6888151 15.341122 5.40625 16.125 C 4.9936569 16.294474 4.6149727 16.61991 4.40625 17 C 4.0986587 17.560133 4 18.207312 4 19.03125 C 4 20.344935 4.3967557 21.534094 5 22.4375 C 5.5160104 23.210266 6.1851229 23.862388 7.0625 24.03125 C 7.3167273 25.6041 8.1589712 26.670949 9.0625 27.28125 C 10.151089 28.016552 11.308296 28.28198 11.59375 28.4375 C 12.684812 29.031269 13.692049 30 16 30 C 18.307951 30 19.315188 29.031269 20.40625 28.4375 C 20.691704 28.28198 21.848911 28.016552 22.9375 27.28125 C 23.841029 26.670949 24.683273 25.6041 24.9375 24.03125 C 25.814877 23.862388 26.48399 23.210266 27 22.4375 C 27.603244 21.534094 28 20.344935 28 19.03125 C 28 18.207312 27.901341 17.560133 27.59375 17 C 27.396013 16.639914 27.042619 16.332023 26.65625 16.15625 C 27.365302 15.380957 28 14.340256 28 13 C 28 12.085083 27.656981 11.101613 27.09375 9.96875 C 26.530519 8.835887 25.713003 7.6051387 24.6875 6.4375 C 22.636494 4.1022225 19.67484 2 16.0625 2 z M 16.0625 4 C 18.89016 4 21.378506 5.6902775 23.1875 7.75 C 24.091997 8.7798613 24.830731 9.905988 25.3125 10.875 C 25.794269 11.844012 26 12.704917 26 13 C 26 13.597583 25.705856 14.205982 25.28125 14.71875 C 25.206236 14.631637 25.089188 14.532966 25 14.4375 L 25 12.59375 C 25 11.843315 24.621684 11.363516 24.15625 10.875 C 23.690816 10.386484 23.055149 9.9219818 22.28125 9.5 C 20.733452 8.6560364 18.587684 8 16 8 C 13.412799 8 11.266461 8.6583013 9.71875 9.5 C 8.9448944 9.9208494 8.3093506 10.387482 7.84375 10.875 C 7.3781494 11.362518 7 11.842979 7 12.59375 L 7 14.4375 C 6.9230018 14.520276 6.8166434 14.610802 6.75 14.6875 C 6.3010373 14.140369 6 13.505869 6 13 C 6 12.728566 6.2038599 11.841617 6.6875 10.875 C 7.1711401 9.9083828 7.900734 8.8150145 8.8125 7.78125 C 10.636032 5.7137209 13.170813 4 16.0625 4 z M 14.96875 5 C 14.96875 5 13.477 7.40875 13.5 7.46875 C 13.522 7.52875 14.375 7.9375 14.375 7.9375 L 15.0625 5.96875 L 16.03125 6.9375 L 16.90625 6 L 17.625 8 L 18.5 7.46875 L 17.0625 5 L 16 5.9375 L 14.96875 5 z M 16 10 C 18.245316 10 20.099798 10.571714 21.34375 11.25 C 21.965726 11.589143 22.439341 11.956735 22.71875 12.25 C 22.928307 12.469949 22.986385 12.654733 23 12.65625 L 23 12.8125 C 21.431642 11.853304 19.144805 11 16 11 C 12.855195 11 10.568358 11.853304 9 12.8125 L 9 12.65625 C 9.0136547 12.654715 9.07182 12.469292 9.28125 12.25 C 9.5604932 11.957612 10.034231 11.588276 10.65625 11.25 C 11.900289 10.573449 13.754201 10 16 10 z M 16 13 C 17.030768 13 17.918728 13.11899 18.71875 13.28125 C 17.667666 13.716963 17.125 14.53125 17.125 14.53125 L 18.875 15.46875 C 18.875 15.46875 19.000561 15 20 15 L 22.6875 15 C 22.803658 15.089722 22.897747 15.16163 23 15.25 L 23 18 L 23 23 C 23 24.628251 22.507661 25.176552 21.84375 25.625 C 21.179839 26.073448 20.290046 26.22302 19.4375 26.6875 C 18.040562 27.447731 17.818049 28 16 28 C 14.181951 28 13.959438 27.447731 12.5625 26.6875 C 11.709954 26.22302 10.820161 26.073448 10.15625 25.625 C 9.4923389 25.176552 9 24.628251 9 23 L 9 18 L 9 15.25 C 9.1022525 15.16163 9.1963416 15.089722 9.3125 15 L 12 15 C 12.999439 15 13.125 15.46875 13.125 15.46875 L 14.875 14.53125 C 14.875 14.53125 14.332334 13.716963 13.28125 13.28125 C 14.081272 13.11899 14.969232 13 16 13 z M 13 17 C 12.447715 17 12 17.671573 12 18.5 C 12 19.062281 12.226038 19.524429 12.53125 19.78125 C 12.236482 20.237446 12.060719 20.769474 12.03125 21.34375 C 10.520238 20.797885 10.375 20 10.375 20 C 10.375 20 10 20.33025 10 21.78125 C 10 23.49025 11.15625 23.5625 11.15625 23.5625 C 11.15625 23.5625 11.30025 25.21875 12.53125 25.21875 C 13.06325 25.21875 13.36525 24.9605 13.40625 24.9375 C 13.47525 25.0215 14.031 26 14.875 26 C 15.531 26 16 25.53125 16 25.53125 C 16 25.53125 16.4885 25.96875 17.1875 25.96875 C 17.9815 25.96875 18.59375 24.96875 18.59375 24.96875 C 18.59375 24.96875 18.92925 25.21875 19.53125 25.21875 C 20.13325 25.21875 20.724 24.7365 20.875 23.5625 C 21.364 23.5625 22 22.7855 22 21.8125 C 22 20.3545 21.65625 20.03125 21.65625 20.03125 C 21.308957 20.618808 20.748259 21.025706 20 21.3125 C 19.963479 20.747931 19.759488 20.23121 19.46875 19.78125 C 19.773962 19.524429 20 19.062281 20 18.5 C 20 17.671573 19.552285 17 19 17 C 18.454805 17 18.011292 17.655018 18 18.46875 C 17.398688 18.164018 16.717141 18 16 18 C 15.282859 18 14.601312 18.164018 14 18.46875 C 13.988708 17.655018 13.545195 17 13 17 z M 6.15625 18 C 6.4814522 17.989565 6.6438238 17.994818 7 18.375 L 7 21.6875 C 6.8935169 21.584696 6.7930809 21.470616 6.6875 21.3125 C 6.3094943 20.746406 6 19.919565 6 19.03125 C 6 18.426125 6.1029836 18.105821 6.15625 18 z M 25.59375 18 C 25.669278 17.99331 25.746592 17.996882 25.84375 18 C 25.897016 18.105821 26 18.426125 26 19.03125 C 26 19.919565 25.690506 20.746406 25.3125 21.3125 C 25.206919 21.470616 25.106483 21.584696 25 21.6875 L 25 18.375 C 25.249765 18.108401 25.416473 18.015702 25.59375 18 z M 16 20 C 17.206487 20 18 20.767816 18 21.5 C 18 22.232184 17.206487 23 16 23 C 14.793513 23 14 22.232184 14 21.5 C 14 20.767816 14.793513 20 16 20 z"/>--}}
                    {{--</svg>--}}


                    {{--<svg id="svg-shroom" style=" @if(!$new) fill: {{$color->hex}}; @else fill: #00BFFF; @endif "xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:cc="http://creativecommons.org/ns#" xmlns:dc="http://purl.org/dc/elements/1.1/"--}}
                         {{--height="256" width="256"--}}
                         {{--viewBox="0 0 256 256">--}}
                        {{--<path id="mainsymbolpath" style="opacity:1;fill-opacity:1;stroke:none"--}}
                              {{--d="m 128,212.38632 c 15.9073,0 34.65561,-2.0023 43.11687,-11.16199 6.29934,-6.8193 7.95659,-19.35241 7.80515,-27.75713 C 175.5147,168.69696 159.88634,155.82487 128,155.82487 c -31.88634,0 -47.5147,12.87209 -50.92202,17.64233 -0.15144,8.40472 1.50581,20.93783 7.80515,27.75713 8.46126,9.15969 27.20957,11.16199 43.11687,11.16199 z m -24.43986,-33.69723 c 0,8.16157 0.77173,15.4721 4.85982,15.4721 4.08809,0 4.85983,-7.11217 4.85983,-15.27374 0,-8.16158 -0.17666,-15.27374 -4.61188,-15.27374 -4.43522,0 -5.10777,6.9138 -5.10777,15.07538 z m 48.87972,0 c 0,8.16157 -0.77173,15.4721 -4.85982,15.4721 -4.08809,0 -4.85983,-7.11217 -4.85983,-15.27374 0,-8.16158 0.17666,-15.27374 4.61188,-15.27374 4.43522,0 5.10777,6.9138 5.10777,15.07538 z M 42.65625,131.59375 c 0,5.69377 0.60849,10.63762 1.6875,14.96875 C 57.9451,135.81508 65.67652,105.32877 58,82.78125 47.61719,99.6068 42.65625,118.5715 42.65625,131.59375 z m 29.75013,53.36262 c -15.81763,-5.83563 -36.74304,-19.32486 -36.74304,-53.35092 0,-34.02606 28.13416,-96.21888 92.33666,-96.21888 64.2025,0 92.33666,62.19282 92.33666,96.21888 0,34.02606 -20.92541,47.51529 -36.74304,53.35092 -2.12331,24.99715 -21.42,34.49785 -55.59362,34.49785 -34.17362,0 -53.47031,-9.5007 -55.59362,-34.49785 z M 198,82.78125 c -7.67652,22.54752 0.0549,53.03383 13.65625,63.78125 1.07901,-4.33113 1.6875,-9.27498 1.6875,-14.96875 0,-13.02225 -4.96094,-31.98695 -15.34375,-48.8125 z m -70,-33.76804 c -24.04063,0 -43.529412,18.89219 -43.529412,42.19688 0,23.3047 19.488782,42.19688 43.529412,42.19688 24.04064,0 43.52942,-18.89218 43.52942,-42.19688 0,-23.30469 -19.48878,-42.19688 -43.52942,-42.19688 z"--}}
                        {{--/>--}}
                    {{--</svg>--}}



                    <div class="text1"><h1>I can show you how i work on a blackboard</h1></div>
                    <div class="text2"><h1>at a carnival</h1></div>
                    <div class="text3"><h1>in the wild west</h1></div>
                    <div class="text4"><h1>and on a speedway</h1></div>



                </div>

                {{--<div id="showmore"> show codes </div>--}}

                <div class="color-codes">
                    <div class="col-lg-3 col-md-6">///// COLOR CODES <br>
                        RGB: rgba(123123123123)<br>
                        HEX: rgba(123123123123)<br>
                        HSL: rgba(123123123123)<br>
                        HSV: rgba(123123123123)
                    </div>
                    <div class="col-lg-5 col-md-6">///// CSS CODES <br>
                        <span class="highlight">.mybgcolor</span> { background-color:#ff9699; }<br>
                        <span class="highlight">.myforecolor</span> { color:#ff9699; }<br>
                        <span class="highlight">.mybordercolor</span> { border:3px solid #ff9699; }<br>
                    </div>
                    <div class="col-lg-4 col-md-12">///// CSS3 EXAMPLES <br>
                        <span class="highlight">.textShadowRgb</span> {<br>
                        text-shadow: 4px 4px 2px rgba(255,150,153, 0.8); <br>
                        }<br>
                        <span class="highlight">.textShadowHex</span> {<br>
                        text-shadow: 4px 4px 2px #ff9699; <br>
                        }<br>
                        <span class="highlight">.divShadow</span> {<br>
                        -moz-box-shadow: 1px 1px 3px 2px #ff9699;<br>
                        -webkit-box-shadow: 1px 1px 3px 2px #ff9699;<br>
                        box-shadow:         1px 1px 3px 2px #ff9699; <br>
                        }<br>
                    </div>
                </div>



                @if(!$new)
                    <div class="comment-wrapper">
                        @if (auth()->check())
                            <form class="addcomment">
                                <input id="newcomment_text" class="addcomment-input" placeholder="Add new comment">
                                <input id="palette_id" class="hidden" value="{{$color->id}}">
                                <a><div class="addcomment-button newcomment">Add comment</div></a>

                            </form>
                        @else
                            <form class="addcomment cantAddNewColor">
                                <input class="addcomment-input" value="Sign in to add new comment" readonly>
                                <div class="addcomment-button">Add comment</div>

                            </form>
                        @endif
                        <div class="comments">
                            @foreach($comments as $comment)
                                <div class="single-comment">
                                    <input class="comment-id hidden" value="{{$comment->id}}">
                                    <div class="user-comment">

                                        <div class="nameandlogo">
                                            <div class="userlogo smalllogo">
                                                <span class="glyphicon glyphicon-user"></span>
                                            </div>
                                            <div class="user-name">{{$comment->creator->name}}</div>
                                        </div>

                                        <div class="dateandcontrols">

                                            <div class="comment-time">{{$comment->created_at->diffForHumans()}}</div>
                                            @if(auth()->check() and auth()->id() == $comment->user_id)
                                                <span class="trash glyphicon glyphicon-trash comment-icon deletecomment"></span>
                                            @endif
                                        </div>


                                    </div>
                                    <div class="comment-text">{{$comment->text}}</div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <meta name="_token" content="{!! csrf_token() !!}" />
@endsection