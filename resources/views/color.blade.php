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
                        <form name="paletaForm" method="post" href="/color/{{$color->id}}">
                    @else
                        <form name="paletaForm" method="post" href="/color">
                    @endif

                    {!! csrf_field() !!}
                    <input name="new" type="text" value="{{$new}}" class="hidden">
                    <!--Title-->
                    <input class="palete-title" name="palettetitle" type="text" value="@if(!$new){{$color->hex}} @else #274380 @endif︎"  spellcheck="false"  readonly>


                    <!--palette controlling buttons-->
                    <div class="controls">
                        <a class="creator" href="#">creator: @if(!$new){{$color->createdby->name}} @else unnamed @endif</a>
                        <div style="max-width: 130px;">
                            @if(auth()->check())
                                <span class="save sort-hidden glyphicon glyphicon-floppy-saved" type="submit"></span>
                            @else
                                <span class="sort-hidden glyphicon glyphicon-floppy-saved cantAddNewColor" type="submit"><span class="login-to-save">Sign in to save your palettes</span></span>
                            @endif
                        </div>
                        <div class="edit"><span class="glyphicon glyphicon-pencil"></span><div>Edit</div></div>
                    </div>



                    <div class="paleta">

                        <!--#1 COLOR-->
                        @if(!$new)
                                <div class="color">
                                    <div class="color-bar">
                                        <input class="color-title" name="color1" type="text" maxlength="7"  value="{{$color->hex}}" pattern="^#[0-9a-fA-F]{6}$" spellcheck="false"  readonly>
                                        <div class="icons">
                                            <span class="glyphicon glyphicon-heart"></span>
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
                        @else
                            <div class="color">
                                <div class="color-bar">
                                    <input class="color-title" name="color1" type="text" maxlength="7"  value="#274380" pattern="^#[0-9a-fA-F]{6}$" spellcheck="false"  readonly>
                                    <div class="icons">
                                        <span class="glyphicon glyphicon-heart"></span>
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
                    <div class="likes"><span class="glyphicon glyphicon-heart"></span><div>@if(!$new){{$color->likes}} @else 0 @endif</div></div>
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