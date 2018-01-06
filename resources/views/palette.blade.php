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
    <script src="../js/palette.js"></script>


@endsection


@section('page_content')

            @if(!$new)
            <?php
            $colors = [];
            if($palette->color1->hex!=null) array_push($colors,$palette->color1);
            if($palette->color2->hex!=null) array_push($colors,$palette->color2);
            if($palette->color3->hex!=null) array_push($colors,$palette->color3);
            if($palette->color4->hex!=null) array_push($colors,$palette->color4);
            if($palette->color5->hex!=null) array_push($colors,$palette->color5);

            $counter = 0;
            $palette->views+=1;
            $palette->save();
            ?>
            @endif


    @if(!$new)
    <form name="paletaForm" method="post" href="/palette/{{$palette->id}}">
    @else
        <form name="paletaForm" method="post" href="/palette">
    @endif
            @if(!$new) @else @endif
    {!! csrf_field() !!}
        <input name="new" type="text" value="{{$new}}" class="hidden">
        <!--Title-->
        <input class="palete-title" name="palettetitle" type="text" value="@if(!$new){{$palette->title}} @else unnamed @endif︎"  spellcheck="false"  readonly>


        <!--palette controlling buttons-->
        <div class="controls">
            <a class="creator" href="#">creator: @if(!$new){{$palette->createdby->name}} @else unnamed @endif</a>
            <div class="newcolor sort-hidden"><span class="glyphicon glyphicon-plus"></span><div>Add new color</div></div>
            <div style="max-width: 130px;">
                @if(auth()->check())
                <span class="save sort-hidden glyphicon glyphicon-floppy-saved" type="submit"></span>
                @else
                    <span class="sort-hidden glyphicon glyphicon-floppy-saved cantAddNewColor" type="submit"><span class="login-to-save">Sign in to save your palettes</span></span>
                @endif
                <span class="move sort-hidden glyphicon glyphicon-align-justify"></span>
            </div>
            <div class="edit"><span class="glyphicon glyphicon-pencil"></span><div>Edit</div></div>
        </div>



        <div class="paleta">

            <!--#1 COLOR-->
            @if(!$new)
            @foreach($colors as $color)
                <?php $counter+=1?>

            <div class="color">
                <div class="color-bar">
                    <input class="colorid hidden" value="{{$color->id}}" readonly>
                    <input class="color-title" name="color{{$counter}}" type="text" maxlength="7"  value="{{$color->hex}}" pattern="^#[0-9a-fA-F]{6}$" spellcheck="false"  readonly>
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
            @endforeach
            @else
                <div class="color">
                    <div class="color-bar">
                        <input class="color-title" name="color1" type="text" maxlength="7"  value="#274380" pattern="^#[0-9a-fA-F]{6}$" spellcheck="false"  readonly>
                        <div class="icons">

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

                <div class="color">
                    <div class="color-bar">
                        <input class="color-title" name="color2" type="text" maxlength="7"  value="#37B8A9" pattern="^#[0-9a-fA-F]{6}$" spellcheck="false"  readonly>
                        <div class="icons">

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

                <div class="color">
                    <div class="color-bar">
                        <input class="color-title" name="color3" type="text" maxlength="7"  value="#ED390C" pattern="^#[0-9a-fA-F]{6}$" spellcheck="false"  readonly>
                        <div class="icons">

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
    <div class="controls downcontrols">
        <div class="views"><span class="glyphicon glyphicon-eye-open"></span><div>@if(!$new){{$palette->views}} @else 0 @endif</div></div>
        <div class="likes"><span class="glyphicon glyphicon-heart"></span><div id="likesamount">@if(!$new){{$palette->likes}} @else 0 @endif</div></div>
    </div>








    <div class="create-gradient">gradient</div>
    <form class="gradient-form squeeze" name="gradientForm" method="post" href="/gradient">
        <div class="gradient-controls">

            <input class="gradient-title" name="name" type="text" maxlength="11" value="unnamed"  spellcheck="false">


            <div class="css-switch-wrapper gradientchange">
                <div class="css-switch-holder">
                    <div class="css-switch">linear</div>
                    <div class="css-switch-circle"></div>
                    <div class="css-switch">radial</div>
                </div>
            </div>

            @if(auth()->check())
                <span class="save-gradient glyphicon glyphicon-floppy-saved" type="submit"></span>
            @else
                <span class="glyphicon glyphicon-floppy-saved cantAddNewColor" type="submit"></span>
            @endif
        </div>

        <div class="gradient-slider">

            @if(!$new)
                <?php $counter2=0?>
                @foreach($colors as $color)
                    <?php $counter2+=1?>
                    <svg id="pointer{{$counter2}}" class="pointer" version="1.1"  xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                         viewBox="0 0 35.2 35.2" style="enable-background:new 0 0 35.2 35.2;" xml:space="preserve">
                    <path d="M17.6,0c-6.6,0-12,5.3-12,11.9c0,3.4,3.3,9.4,3.3,9.4l8.2,14l8.6-13.8c0,0,3.8-5.7,3.8-9.5C29.6,5.3,24.2,0,17.6,0z
                    M17.6,18.4c-3.8,0-6.8-3.1-6.8-6.9c0-3.8,3.1-6.8,6.8-6.8c3.8,0,6.9,3.1,6.9,6.8C24.4,15.4,21.3,18.4,17.6,18.4z"/>
                    <circle class="pointercolor" cx="17.6" cy="11.6" r="10"/>
                    </svg>
                @endforeach
            @else
                                <svg id="pointer1" class="pointer" version="1.1"  xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                     viewBox="0 0 35.2 35.2" style="enable-background:new 0 0 35.2 35.2;" xml:space="preserve">
                    <path d="M17.6,0c-6.6,0-12,5.3-12,11.9c0,3.4,3.3,9.4,3.3,9.4l8.2,14l8.6-13.8c0,0,3.8-5.7,3.8-9.5C29.6,5.3,24.2,0,17.6,0z
                    M17.6,18.4c-3.8,0-6.8-3.1-6.8-6.9c0-3.8,3.1-6.8,6.8-6.8c3.8,0,6.9,3.1,6.9,6.8C24.4,15.4,21.3,18.4,17.6,18.4z"/>
                                    <circle class="pointercolor" cx="17.6" cy="11.6" r="10"/>
                    </svg>
                                <svg id="pointer2" class="pointer" version="1.1"  xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                     viewBox="0 0 35.2 35.2" style="enable-background:new 0 0 35.2 35.2;" xml:space="preserve">
                    <path d="M17.6,0c-6.6,0-12,5.3-12,11.9c0,3.4,3.3,9.4,3.3,9.4l8.2,14l8.6-13.8c0,0,3.8-5.7,3.8-9.5C29.6,5.3,24.2,0,17.6,0z
                    M17.6,18.4c-3.8,0-6.8-3.1-6.8-6.9c0-3.8,3.1-6.8,6.8-6.8c3.8,0,6.9,3.1,6.9,6.8C24.4,15.4,21.3,18.4,17.6,18.4z"/>
                                    <circle class="pointercolor" cx="17.6" cy="11.6" r="10"/>
                    </svg>
                                <svg id="pointer3" class="pointer" version="1.1"  xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                     viewBox="0 0 35.2 35.2" style="enable-background:new 0 0 35.2 35.2;" xml:space="preserve">
                    <path d="M17.6,0c-6.6,0-12,5.3-12,11.9c0,3.4,3.3,9.4,3.3,9.4l8.2,14l8.6-13.8c0,0,3.8-5.7,3.8-9.5C29.6,5.3,24.2,0,17.6,0z
                    M17.6,18.4c-3.8,0-6.8-3.1-6.8-6.9c0-3.8,3.1-6.8,6.8-6.8c3.8,0,6.9,3.1,6.9,6.8C24.4,15.4,21.3,18.4,17.6,18.4z"/>
                                    <circle class="pointercolor" cx="17.6" cy="11.6" r="10"/>
                    </svg>
            @endif




        </div>

        <div class="color-codes">
            <div class="col-lg-12 col-md-12">///// CSS CODES <br>
                <span class="highlight">.mylineargradient</span> { background-color:#ff9699; }<br>
                <span class="highlight">.mylineargradient</span> { color:#ff9699; }<br>
                <span class="highlight">.mylineargradient</span> { border:3px solid #ff9699; }<br>
            </div>
        </div>


    </form>








    @if(!$new)
    <div class="comment-wrapper">
        @if (auth()->check())
        <form class="addcomment">
            <input id="newcomment_text" class="addcomment-input" placeholder="Add new comment">
            <input id="palette_id" class="hidden" value="{{$palette->id}}">
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