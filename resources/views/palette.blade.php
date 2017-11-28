@extends('layouts/master')

@section('page_css')

    <!-- external CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" crossorigin="anonymous">
    <link type="text/css" href="../css/jquery-ui.min.css" rel="Stylesheet" />
    <link type="text/css" href="../css/jquery-ui.structure.min.css" rel="Stylesheet" />
    <link type="text/css" href="../css/jquery-ui.theme.min.css" rel="Stylesheet" />
    <link type="text/css" rel="stylesheet" href="../css/wheelcolorpicker.css">

    <!--my css-->
    <link rel="stylesheet" href="../css/menu.css">
    <link rel="stylesheet" href="../css/palette.css">

@endsection



@section('page_js')

    <!-- external JS -->
    <script src="../js/colorconversion.js"></script>
    <script src="../js/jquery.js"></script>
    <script src="../js/jquery-ui.min.js"></script>
    <script src="../js/jquery.ui.touch-punch.min.js"></script>
    <script type="text/javascript" src="../js/jquery.wheelcolorpicker.js"></script>

    <!--my js-->
    <script src="../js/menu.js"></script>
    <script src="../js/palette.js"></script>


@endsection


@section('page_content')

    <form name="paletaForm">


        <!--Title-->
        <input class="palete-title" name="palettetitle" type="text" value="☣︎ Bio-Hazzard ☣︎"  spellcheck="false"  readonly>


        <!--palette controlling buttons-->
        <div class="controls">
            <a class="creator" href="#">creator: Gtluszcz</a>
            <div class="newcolor sort-hidden"><span class="glyphicon glyphicon-plus"></span><div>Add new color</div></div>
            <div>
                <span class="save sort-hidden glyphicon glyphicon-floppy-saved" type="submit"></span>
                <span class="move sort-hidden glyphicon glyphicon-align-justify"></span>
            </div>
            <div class="edit"><span class="glyphicon glyphicon-pencil"></span><div>Edit</div></div>
        </div>



        <div class="paleta">

            <!--#1 COLOR-->
            <div class="color active">
                <div class="color-bar">
                    <input class="color-title" name="color1" type="text" maxlength="7"  value="#6400A8" pattern="^#[0-9a-fA-F]{6}$" spellcheck="false"  readonly>
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



            <!--#2 COLOR-->
            <div class="color">
                <div class="color-bar">
                    <input class="color-title" name="color1" type="text" maxlength="7"  value="#0260f7" pattern="^#[0-9a-fA-F]{6}$" spellcheck="false"  readonly>
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
                                R:  <div class="rgb-r value">255</div>
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


        </div>
    </form>
    </div>

    <!--below palette controlling buttons-->
    <div class="controls">
        <div class="views"><span class="glyphicon glyphicon-eye-open"></span><div>5654747</div></div>
        <div class="likes"><span class="glyphicon glyphicon-heart"></span><div>89089</div></div>
    </div>


@endsection