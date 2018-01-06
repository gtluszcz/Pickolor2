/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 53);
/******/ })
/************************************************************************/
/******/ ({

/***/ 53:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(54);


/***/ }),

/***/ 54:
/***/ (function(module, exports) {

$(document).ready(function () {

    var linear = true;
    $('.wheel-picker').wheelColorPicker({
        sliders: "w",
        layout: "block",
        autoResize: false

    });
    var editable = false;

    /// if creating new palette
    $('.paleta').ready(function () {
        if (window.location.pathname == '/palette') {
            editable = true;
            $('.edit').addClass('hidden');
            $('.creator').addClass('hidden');
            $('.newcolor').removeClass('sort-hidden');
            $('.move').removeClass('sort-hidden');
            $('.glyphicon-floppy-saved').removeClass('sort-hidden');
            $('.glyphicon-trash').removeClass('sort-hidden');
            $('.color-title').attr("readonly", false);
            $('.palete-title').attr("readonly", false);
            $('.palete-title').focus();
            $(".slider").slider("enable");
            $('.picker').removeClass('disabled');
            $('.likes').addClass('hidden');
            $('.views').addClass('hidden');
            $('.likeheart').addClass('hidden');
            $('.glyphicon-heart.cantAddNewColor').addClass('hidden');
            $('.comment-wrapper').addClass('hidden');
            $('.downcontrols').addClass('hidden');
            if ($('.paleta').children('.color').length <= 2) {
                $('.glyphicon-trash').addClass('sort-hidden');
            }
        }
    });

    //fix comments lenghts
    $('.comments').show(function () {
        $('.comment-text').each(function () {
            var ruler = $("<span>" + $(this).html() + "</span>").css({
                'position': 'absolute',
                'white-space': 'nowrap',
                'visibility': 'hidden'
            }).css("font", $(this).css("font"));

            // Render ruler, measure, then remove
            $("body").append(ruler);
            var w = ruler.width();
            ruler.remove();
            w = w + ($(this).innerWidth() - $(this).width());

            $(this).closest('.single-comment').width(w);
        });
    });

    ///TABS
    ///////
    //////
    ////
    ///
    //

    linkTabs();

    function linkTabs() {
        $(".tabs-link").each(function (uniqueindex) {
            $(this).attr('target', 'tab-' + uniqueindex);
        });
        $(".link").each(function (uniqueindex) {
            $(this).attr('id', 'tab-' + uniqueindex);
        });
    }

    //Switch tabs
    $('.paleta').on("click", '.tabs-link', function () {
        var target = $(this).attr('target');
        updateHSLSliders($(this).closest('.color'));
        updateRGBSliders($(this).closest('.color'));
        $(this).closest('.color').find(".link").each(function () {
            $(this).addClass('hidden');
        });
        $(this).closest('.color').find("#" + target).removeClass('hidden');
        $(this).closest('.color').find(".tabs-link").each(function () {
            $(this).removeClass('active-tab');
        });
        $(this).addClass('active-tab');
    });

    //
    ///
    ////
    /////
    //////
    ///////


    ///SLIDER
    ///////
    //////
    ////
    ///
    //

    //Enable rgb sliders
    function switchOnSliders() {
        $(".rgb-slider").slider({
            min: 0,
            max: 255,
            step: 1,
            slide: function slide(event, ui) {
                var value = ui.value;
                $(this).siblings('.value').text(value);
                movedRGBSlider(this, value);
            }
        });

        $(".percent-slider").slider({
            min: 0,
            max: 100,
            step: 1,
            slide: function slide(event, ui) {
                var value = ui.value;
                $(this).siblings('.value').text(value + '%');
                movedHSLSlider(this, value);
            }
        });

        $(".hue-slider").slider({
            min: 0,
            max: 360,
            step: 1,
            slide: function slide(event, ui) {
                var value = ui.value;
                $(this).siblings('.value').text(value);
                movedHSLSlider(this);
            }
        });
    }
    switchOnSliders();
    $(".rgb-slider").slider("disable");
    $(".hue-slider").slider("disable");
    $(".percent-slider").slider("disable");

    function movedRGBSlider(slider) {
        if ($(slider).hasClass('rgb-r-slider') || $(slider).hasClass('rgb-g-slider') || $(slider).hasClass('rgb-b-slider')) {
            var r = $(slider).closest('.color').find('.rgb-r').text();
            var g = $(slider).closest('.color').find('.rgb-g').text();
            var b = $(slider).closest('.color').find('.rgb-b').text();
            var color = rgbToHex(r, g, b);
            changeColor($(slider).closest('.color'), color);
        }
    }

    function movedHSLSlider(slider) {
        if ($(slider).hasClass('hsl-h-slider') || $(slider).hasClass('hsl-s-slider') || $(slider).hasClass('hsl-l-slider')) {
            var h = $(slider).closest('.color').find('.hsl-h').text();
            var s = $(slider).closest('.color').find('.hsl-s').text();
            var l = $(slider).closest('.color').find('.hsl-l').text();
            var color = hsl2rgb(h, s, l);
            var color1 = rgbToHex(color.r, color.g, color.b);
            changeColor($(slider).closest('.color'), color1);
        }
    }

    //
    ///
    ////
    /////
    //////
    ///////


    ///PALETA
    ///////
    //////
    ////
    ///
    //

    //init sorting
    $('.paleta').sortable({
        containment: "parent",
        disabled: true,
        tolerance: "pointer",
        update: function update() {
            changeBackgroundColor();
            matchNames();
        }
    });
    $('.paleta').disableSelection();

    //Manage sorting button / enable sorting
    $('.move').click(function () {
        $('.color').removeClass('active');

        if (sortable === false) {
            $(".paleta").sortable("enable");
            $(".glyphicon-sort").removeClass('sort-hidden');
            sortable = true;
        } else {
            $(".paleta").sortable("disable");
            $(".color").first().addClass('active');
            $(".glyphicon-sort").addClass('sort-hidden');
            sortable = false;
        }

        if (clickDisabled === false) {
            clickDisabled = true;
        } else {
            clickDisabled = false;
        }
    });

    //Match form names after sorting
    function matchNames() {
        $(".color-title").each(function (index) {
            index = index + 1;
            $(this).attr('name', 'color' + index);
        });
        $(".pointer").each(function (index) {
            index = index + 1;
            $(this).attr('id', 'pointer' + index);
        });
        matchgradientcolors();
    }

    //CLICK ON COLOR / ACTIVATE
    var clickDisabled = false;
    var sortable = false;
    $('.paleta').on('click', '.color', function (event) {

        if (clickDisabled || $(event.target).is('.glyphicon')) {
            return;
        }
        $('.color').removeClass('active');
        $(this).addClass('active');
    });

    //Edit palette
    $('.edit').click(function () {
        editable = true;
        $(this).addClass('hidden');
        $('.creator').addClass('hidden');
        $('.newcolor').removeClass('sort-hidden');
        $('.move').removeClass('sort-hidden');
        $('.glyphicon-floppy-saved').removeClass('sort-hidden');
        $('.glyphicon-trash').removeClass('sort-hidden');
        $('.color-title').attr("readonly", false);
        $('.palete-title').attr("readonly", false);
        $('.palete-title').focus();
        $(".slider").slider("enable");
        $('.picker').removeClass('disabled');
        $('.likes').addClass('hidden');
        $('.views').addClass('hidden');
        $('.likeheart').addClass('hidden');
        $('.glyphicon-heart.cantAddNewColor').addClass('hidden');
        $('.comment-wrapper').addClass('hidden');
        $('.downcontrols').addClass('hidden');
        if ($('.paleta').children('.color').length <= 2) {
            $('.glyphicon-trash').addClass('sort-hidden');
        }
    });

    //Finish edit palete title with enter
    $('.paleta').on('keypress', '.palete-title', function (e) {
        if (e.which == 13) {
            e.preventDefault();
            $(this).blur();
        }
    });

    //remove color
    $('.paleta').on('click', '.glyphicon-trash', function () {
        $(this).closest('.color').addClass('pre-remove-color');
        var color = this;
        var index = $(this).closest('.color').find('.color-title').attr("name").slice(-1);
        $('#pointer' + index).addClass("pointer-hide");
        setTimeout(function () {
            color.closest('.color').remove();
            $('#pointer' + index).remove();
            checkIfCanAdd();
            matchgradientcolors();
            matchpointerpositions();
            changeBackgroundColor();
            matchNames();
        }, 400);
        if ($('.paleta').children('.color').length <= 3) {
            $('.glyphicon-trash').addClass('sort-hidden');
        }
    });

    //addcolor
    function checkIfCanAdd() {
        if ($('.paleta').children('.color').length >= 5) {
            $('.newcolor').addClass('cantAddNewColor');
            return false;
        } else {
            $('.newcolor').removeClass('cantAddNewColor');
            return true;
        }
    }

    //Check for colors amount on start and change .color background
    $('.paleta').show(function () {
        checkIfCanAdd();
        $(".color").each(function (index) {
            changeColor($(this), $(this).find('.color-title').val());
            updateRGBSliders($(this));
            updateHSLSliders($(this));
        });
    });

    $('.newcolor').click(function () {
        if (checkIfCanAdd() && editable) {

            //append new html
            var mySecondDiv = $('<div class="color">\n' + '                <div class="color-bar">\n' + '                    <input class="color-title" name="color1" type="text" maxlength="7"  value="#232323" pattern="^#[0-9a-fA-F]{6}$" spellcheck="false">\n' + '                    <div class="icons">\n' + '                        <span class="glyphicon glyphicon-trash sort-hidden"></span>\n' + '                        <span class="glyphicon glyphicon-sort sort-hidden"></span>\n' + '                    </div>\n' + '                </div>\n' + '\n' + '                <div class="color-content col-lg-12">\n' + '                    <div class="suwaki col-lg-7 col-md-7 col-sm-12 col-xs-12">\n' + '                        <div class="tabs-nav">\n' + '                            <a target="" class="tabs-link active-tab">RGB</a>\n' + '                            <a target="" class="tabs-link">HSL</a>\n' + '                        </div>\n' + '                        <div id="" class="link">\n' + '                            <div class="property">\n' + '                                R:  <div class="rgb-r value">255</div><div class="rgb-r-slider rgb-slider slider"><div class="slider-handle-wraper"><span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default" style="left: 0%;"></span></div></div>\n' + '                            </div>\n' + '                            <div class="property">\n' + '                                G:  <div class="rgb-g value">255</div><div class="rgb-g-slider rgb-slider slider"><div class="slider-handle-wraper"><span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default" style="left: 0%;"></span></div></div>\n' + '                            </div>\n' + '                            <div class="property">\n' + '                                B: <div class="rgb-b value">255</div><div class="rgb-b-slider rgb-slider slider"><div class="slider-handle-wraper"><span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default" style="left: 0%;"></span></div></div>\n' + '                            </div>\n' + '                        </div>\n' + '                        <div id="" class="link hidden">\n' + '                            <div class="property">\n' + '                                H:<div class="hsl-h value">360</div><div class="hsl-h-slider slider hue-slider"><div class="slider-handle-wraper"><span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default" style="left: 0%;"></span></div></div>\n' + '                            </div>\n' + '                            <div class="property">\n' + '                                S:<div class="hsl-s value">100%</div><div class="hsl-s-slider slider percent-slider"><div class="slider-handle-wraper"><span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default" style="left: 0%;"></span></div></div>\n' + '                            </div>\n' + '                            <div class="property">\n' + '                                L:<div class="hsl-l value">100%</div><div class="hsl-l-slider slider percent-slider"><div class="slider-handle-wraper"><span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default" style="left: 0%;"></span></div></div>\n' + '                            </div>\n' + '                        </div>\n' + '                    </div>\n' + '\n' + '                    <div class="picker col-lg-5 col-md-5 col-sm-12 col-xs-12 ">\n' + '                        <input class="wheel-picker disabled">\n' + '                    </div>\n' + '\n' + '                </div>\n' + '            </div>');

            var newpointer = $(' <svg id="pointer" class="pointer" version="1.1"  xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"\n' + '                  viewBox="0 0 35.2 35.2" style="enable-background:new 0 0 35.2 35.2;" xml:space="preserve">\n' + '            <path d="M17.6,0c-6.6,0-12,5.3-12,11.9c0,3.4,3.3,9.4,3.3,9.4l8.2,14l8.6-13.8c0,0,3.8-5.7,3.8-9.5C29.6,5.3,24.2,0,17.6,0z\n' + '            M17.6,18.4c-3.8,0-6.8-3.1-6.8-6.9c0-3.8,3.1-6.8,6.8-6.8c3.8,0,6.9,3.1,6.9,6.8C24.4,15.4,21.3,18.4,17.6,18.4z"/>\n' + '                 <circle  cx="17.6" cy="11.6" r="10"/>\n' + '            </svg>');

            $('.paleta').append(mySecondDiv);
            $('.gradient-slider').append(newpointer);
            if (sortable === true) {
                $(".glyphicon-sort").removeClass('sort-hidden');
            } else {
                $(".glyphicon-sort").addClass('sort-hidden');
            }
            if (editable === true) {
                $(".glyphicon-trash").removeClass('sort-hidden');
            }

            $('.color').last().find('.wheel-picker').wheelColorPicker({
                sliders: "w",
                layout: "block",
                autoResize: false

            });

            $(".pointer").last().draggable({
                containment: "parent",
                axis: "x",
                stack: ".pointer",
                stop: function stop(event, ui) {
                    var left = $(this).offset().left - $('.gradient-slider').position().left;
                    var width = $('.gradient-slider').width();
                    $(this).css("left", left / width * 100 + '%');
                },
                drag: function drag(event, ui) {
                    changeBackgroundColor();
                }
            });

            linkTabs();

            //match names in form due to new color
            matchNames();

            switchOnSliders();
            //first switch on sliders then change color then adjust position

            //initiate and assign proper values in new color
            changeColor($('.color').last(), $('.color-title').last().val());

            updateHSLSliders($('.color').last());
            updateRGBSliders($('.color').last());

            if ($('.paleta').children('.color').length >= 3) {
                $('.glyphicon-trash').removeClass('sort-hidden');
            }
        }
        checkIfCanAdd();
    });

    //submit form
    $('.save').click(function () {
        document.paletaForm.submit();
    });

    //
    ///
    ////
    /////
    //////
    ///////


    ///COLOR PICKER
    ///////
    //////
    ////
    ///
    //

    $('.paleta').on('slidermove', '.wheel-picker', function () {
        colorPickerUsed($(this));
    });
    $('.paleta').on('sliderup', '.wheel-picker', function () {
        colorPickerUsed($(this));
    });

    function colorPickerUsed(picker) {
        var color = picker.wheelColorPicker('value');
        colorhex = "#" + color;
        changeColor(picker.closest('.color'), colorhex);
        updateHSLSliders(picker.closest('.color'), colorhex);
        updateRGBSliders(picker.closest('.color'), colorhex);
    }

    function updateColorPicker(picker, color) {
        picker.wheelColorPicker('value', color);
    }

    //
    ///
    ////
    /////
    //////
    ///////


    ///COLOR
    ///////
    //////
    ////
    ///
    //

    //remember last color
    var lastcolor;
    $('.paleta').on('focus', '.color-title', function () {
        lastcolor = $(this).val();
    });

    //Finish edit color-title with enter
    $('.paleta').on('keypress', '.color-title', function (e) {
        if (e.which == 13) {
            e.preventDefault();
            $(this).blur();
        }
    });

    //Check if color-title value matches hex
    $('.paleta').on('focusout', '.color-title', function () {
        var alphaExp = /^#[0-9a-fA-F]{6}$/;
        if ($(this).val().match(alphaExp) && $(this).val() !== lastcolor) {
            changeColor($(this).closest('.color'), $(this).val());
            updateRGBSliders($(this).closest('.color'));
            updateHSLSliders($(this).closest('.color'));
        } else {
            $(this).val(lastcolor);
        }
    });

    function updateRGBSliders(object) {
        var colorhex = object.find(".color-title").val();
        object.find('.rgb-r').text(hexToRgb(colorhex).r);
        object.find('.rgb-r-slider').children().first().children().first().css('left', hexToRgb(colorhex).r * 100 / 255 + "%");

        object.find('.rgb-g').text(hexToRgb(colorhex).g);
        object.find('.rgb-g-slider').children().first().children().first().css('left', hexToRgb(colorhex).g * 100 / 255 + "%");

        object.find('.rgb-b').text(hexToRgb(colorhex).b);
        object.find('.rgb-b-slider').children().first().children().first().css('left', hexToRgb(colorhex).b * 100 / 255 + "%");
    }

    function updateHSLSliders(object) {
        var colorhex = object.find(".color-title").val();
        object.find('.hsl-h').text(hexToHsl(colorhex).H);
        object.find('.hsl-h-slider').children().first().children().first().css('left', hexToHsl(colorhex).H / 360 * 100 + "%");

        object.find('.hsl-s').text(hexToHsl(colorhex).S + '%');
        object.find('.hsl-s-slider').children().first().children().first().css('left', hexToHsl(colorhex).S + "%");

        object.find('.hsl-l').text(hexToHsl(colorhex).L + '%');
        object.find('.hsl-l-slider').children().first().children().first().css('left', hexToHsl(colorhex).L + "%");
    }

    function changeColor(object, colorhex) {

        //change .color-title value
        object.find('.color-title').val(colorhex);

        //update color picker value
        var picker = object.find('.wheel-picker');
        updateColorPicker(picker, colorhex);

        //update hsl saturation and iluminancy slider
        object.find('.hsl-s-slider').css('background', "linear-gradient(to right, hsla(0,0%,50%,1) 0%, hsla(" + hexToHsl(colorhex).H + ",100%,50%,1) 100%)");
        object.find('.hsl-l-slider').css('background', "linear-gradient(to right, hsla(0,0%,0%,1) 0%, hsla(" + hexToHsl(colorhex).H + ",100%,50%,1) 50%,hsla(0,0%,100%,1) 100%)");

        //change .color background-color
        object.css("background-color", colorhex);

        //calculate iluminancy and change fonts
        var hsl = rgbToHsl(hexToRgb(colorhex).r, hexToRgb(colorhex).g, hexToRgb(colorhex).b);
        if (hsl[2] > 0.7) {
            object.css("color", 'black');
            $('body').css("color", 'black');
        } else if (hsl[2] <= 0.7) {
            object.css("color", 'white');
        }
        matchgradientcolors();
        matchpointerpositions();
        //initiate background gradient change to match new color
        changeBackgroundColor();
    }

    //
    ///
    ////
    /////
    //////
    ///////


    function changeBackgroundColor() {

        var colors = [];
        $(".color-title").each(function (index) {
            colors[index] = $(this).val();
        });
        var percents = [];
        $(".pointer").each(function (index) {
            var left = $(this).offset().left - $('.gradient-slider').position().left;
            var width = $('.gradient-slider').width();
            percents[index] = left / width * 100 + '%';
        });
        var coloramount = colors.length;
        if (linear == true) {
            if (coloramount == 1) {
                $("body").css("background", colors[0]);
            } else if (coloramount == 2) {
                $("body").css("background", 'linear-gradient(to bottom, ' + colors[0] + ' ' + percents[0] + ',' + colors[1] + ' ' + percents[1] + ')');
            } else if (coloramount == 3) {
                $("body").css("background", 'linear-gradient(to bottom, ' + colors[0] + ' ' + percents[0] + ',' + colors[1] + ' ' + percents[1] + ',' + colors[2] + ' ' + percents[2] + ')');
            } else if (coloramount == 4) {
                $("body").css("background", 'linear-gradient(to bottom, ' + colors[0] + ' ' + percents[0] + ',' + colors[1] + ' ' + percents[1] + ',' + colors[2] + ' ' + percents[2] + ',' + colors[3] + ' ' + percents[3] + ')');
            } else if (coloramount == 5) {
                $("body").css("background", 'linear-gradient(to bottom, ' + colors[0] + ' ' + percents[0] + ',' + colors[1] + ' ' + percents[1] + ',' + colors[2] + ' ' + percents[2] + ',' + colors[3] + ' ' + percents[3] + ',' + colors[4] + ' ' + percents[4] + ')');
            }
        } else {
            if (coloramount == 1) {
                $("body").css("background", colors[0]);
            } else if (coloramount == 2) {
                $("body").css("background", 'radial-gradient(' + colors[0] + ' ' + percents[0] + ',' + colors[1] + ' ' + percents[1] + ')');
            } else if (coloramount == 3) {
                $("body").css("background", 'radial-gradient(' + colors[0] + ' ' + percents[0] + ',' + colors[1] + ' ' + percents[1] + ',' + colors[2] + ' ' + percents[2] + ')');
            } else if (coloramount == 4) {
                $("body").css("background", 'radial-gradient(' + colors[0] + ' ' + percents[0] + ',' + colors[1] + ' ' + percents[1] + ',' + colors[2] + ' ' + percents[2] + ',' + colors[3] + ' ' + percents[3] + ')');
            } else if (coloramount == 5) {
                $("body").css("background", 'radial-gradient(' + colors[0] + ' ' + percents[0] + ',' + colors[1] + ' ' + percents[1] + ',' + colors[2] + ' ' + percents[2] + ',' + colors[3] + ' ' + percents[3] + ',' + colors[4] + ' ' + percents[4] + ')');
            }
        }

        changeFontsColor(colors);
        changegradientcode();
    }

    function changeFontsColor(colors) {
        var coloramount = colors.length;
        if (coloramount == 1) {
            var hsl = rgbToHsl(hexToRgb(colors[0]).r, hexToRgb(colors[0]).g, hexToRgb(colors[0]).b);
            if (hsl[2] > 0.7) {
                changeelemntscolorto("black");
            } else if (hsl[2] <= 0.7) {
                changeelemntscolorto("white");
            }
        } else if (coloramount >= 2) {
            var hsl = rgbToHsl(hexToRgb(colors[0]).r, hexToRgb(colors[0]).g, hexToRgb(colors[0]).b);
            var hsl2 = rgbToHsl(hexToRgb(colors[1]).r, hexToRgb(colors[1]).g, hexToRgb(colors[1]).b);
            if (hsl[2] > 0.7 || hsl2[2] > 0.7) {
                changeelemntscolorto("black");
            } else if (hsl[2] <= 0.7 && hsl2[2] <= 0.7) {
                changeelemntscolorto("white");
            }
        }
    }
    function changeelemntscolorto(color) {
        $('body').css("color", color);
        $('.nav-icon4 span').css('background-color', color);
        if (color == "black") {} else {}
    }

    ///Manage comments


    $('.newcomment').click(function (e) {
        var whitespace = new RegExp('^\\s*$');
        if (!whitespace.test($('#newcomment_text').val())) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });

            e.preventDefault();

            var formData = {
                text: $('#newcomment_text').val(),
                palette_id: $('#palette_id').val()
            };

            var comment = $('<div class="single-comment">\n' + '                <input class="comment-id hidden" value="cikos">\n' + '                <div class="user-comment">\n' + '\n' + '                    <div class="nameandlogo">\n' + '                        <div class="userlogo smalllogo">\n' + '                            <span class="glyphicon glyphicon-user"></span>\n' + '                        </div>\n' + '                        <div class="user-name">' + $('#user_name').html() + '</div>\n' + '                    </div>\n' + '\n' + '                    <div class="dateandcontrols">\n' + '\n' + '                        <div class="comment-time">just now</div>\n' + '                    </div>\n' + '\n' + '\n' + '                </div>\n' + '                <div class="comment-text">' + $('#newcomment_text').val() + '</div>\n' + '            </div>');

            $('.comments').append(comment);

            var ruler = $("<span>" + $(comment).find('.comment-text').html() + "</span>").css({
                'position': 'absolute',
                'white-space': 'nowrap',
                'visibility': 'hidden'
            }).css("font", $(this).css("font"));

            // Render ruler, measure, then remove
            $("body").append(ruler);
            var w = ruler.width();
            ruler.remove();
            w = w + 2 * ($(this).innerWidth() - $(this).width()) + 20;

            $(comment).width(w);
            var id = $(comment).find('.comment-id');

            $.ajax({

                type: 'POST',
                url: '/pcomments/new',
                data: formData,
                dataType: 'json',
                success: function success(data) {
                    console.log(data.data);
                    id.attr("value", data.data);
                    var trash = $('<span class="trash glyphicon glyphicon-trash comment-icon deletecomment"></span>\n');
                    $(comment).find('.dateandcontrols').append(trash);
                },
                error: function error(data) {
                    console.log('Error:', data);
                }
            });

            $('#newcomment_text').val("");
        } else {
            $('#newcomment_text').val("");
            $('#newcomment_text').attr("placeholder", "Napisz swój komentarz zanim go dodasz");
        }
    });

    $('body').on('click', '.deletecomment', function (e) {
        e.preventDefault();
        if (confirm("Do you realy want to delete comment?") == true) {
            //OK
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });

            var comment_id = $(this).closest('.single-comment').find('.comment-id').val();
            $(this).closest('.single-comment').remove();

            $.ajax({
                type: 'DELETE',
                url: '/pcomments/' + comment_id,
                success: function success(data) {},
                error: function error(data) {
                    console.log('Error:', data);
                }
            });
        }
    });

    //manage likes

    $('.likeheart').click(function (e) {

        e.preventDefault();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });

        var color_id = $(this).parent().parent().find('.colorid').val();

        if ($(this).hasClass('glyphicon-heart-empty')) {
            //LIKE
            $(this).removeClass('glyphicon-heart-empty');
            $(this).addClass('glyphicon-heart');

            var type = "POST";
        } else if ($(this).hasClass('glyphicon-heart')) {
            //UNLIKE
            $(this).removeClass('glyphicon-heart');
            $(this).addClass('glyphicon-heart-empty');
            var type = "DELETE";
        }

        $.ajax({
            type: type,
            url: '/likecolor/' + color_id,
            success: function success(data) {},
            error: function error(data) {
                console.log('Error:', data);
            }
        });
    });

    /// Gradient
    $('.create-gradient').click(function () {
        $('.gradient-form').removeClass('squeeze');
        $('.create-gradient').addClass('button-hide');
    });

    $(".pointer").draggable({
        containment: "parent",
        axis: "x",
        stack: ".pointer",
        stop: function stop(event, ui) {
            var left = $(this).offset().left - $('.gradient-slider').position().left;
            var width = $('.gradient-slider').width();
            $(this).css("left", left / width * 100 + '%');
        },
        drag: function drag(event, ui) {
            changeBackgroundColor();
        }
    });

    function matchgradientcolors() {
        $(".color-title").each(function (index) {
            index = index + 1;
            var color = $(this).val();
            $("#pointer" + index + " circle").css('fill', color);
        });
    }
    function matchpointerpositions() {
        var amount = $('.gradient-slider').children().length;
        var prc = 100 / (amount - 1);
        var offset = 0;
        $(".color-title").each(function (index) {
            index = index + 1;
            $("#pointer" + index).css('left', offset + '%');
            offset += prc;
        });
    }

    $(".gradientchange").click(function () {
        $('.css-switch-holder').toggleClass('css-switch-other');
        linear = !linear;
        changeBackgroundColor();
    });

    function changegradientcode() {
        var colors = [];
        $(".color-title").each(function (index) {
            colors[index] = $(this).val();
        });
        var percents = [];
        $(".pointer").each(function (index) {
            var left = $(this).offset().left - $('.gradient-slider').position().left;
            var width = $('.gradient-slider').width();
            percents[index] = Math.round(left / width * 100) + '%';
        });
        var coloramount = colors.length;
        var code;
        var start;

        if (linear == true) {
            start = 'linear-gradient(to bottom, ';
        } else {
            start = 'radial-gradient(';
        }

        if (coloramount == 1) {
            var color = tinycolor(colors[0]);
            code = $('<div class="col-lg-12 col-md-12">///// CSS CODES <br>\n' + '                <span class="highlight">.mygradient</span> { background-color:' + colors[0] + '; }<br>\n' + '                <span class="highlight">.mygradient</span> { background-color:' + color.toRgbString() + '; }<br>\n' + '            </div>');
        } else if (coloramount == 2) {
            var color = tinycolor(colors[0]);
            var color2 = tinycolor(colors[1]);
            code = $('<div class="col-lg-12 col-md-12">///// CSS CODES <br>\n' + '                <span class="highlight">.mygradient</span> { background: ' + start + colors[0] + ' ' + percents[0] + ', ' + colors[1] + ' ' + percents[1] + '); }<br>\n' + '                <span class="highlight">.mygradient</span> { background: ' + start + color.toRgbString() + ' ' + percents[0] + ', ' + color2.toRgbString() + ' ' + percents[1] + '); }<br>\n' + '            </div>');
        } else if (coloramount == 3) {
            var color = tinycolor(colors[0]);
            var color2 = tinycolor(colors[1]);
            var color3 = tinycolor(colors[2]);
            code = $('<div class="col-lg-12 col-md-12">///// CSS CODES <br>\n' + '                <span class="highlight">.mygradient</span> { background: ' + start + colors[0] + ' ' + percents[0] + ', ' + colors[1] + ' ' + percents[1] + ', ' + colors[2] + ' ' + percents[2] + '); }<br>\n' + '                <span class="highlight">.mygradient</span> { background: ' + start + color.toRgbString() + ' ' + percents[0] + ', ' + color2.toRgbString() + ' ' + percents[1] + ', ' + color3.toRgbString() + ' ' + percents[2] + '); }<br>\n' + '            </div>');
        } else if (coloramount == 4) {
            var color = tinycolor(colors[0]);
            var color2 = tinycolor(colors[1]);
            var color3 = tinycolor(colors[2]);
            var color4 = tinycolor(colors[3]);
            code = $('<div class="col-lg-12 col-md-12">///// CSS CODES <br>\n' + '                <span class="highlight">.mygradient</span> { background: ' + start + colors[0] + ' ' + percents[0] + ', ' + colors[1] + ' ' + percents[1] + ', ' + colors[2] + ' ' + percents[2] + ', ' + colors[3] + ' ' + percents[3] + '); }<br>\n' + '                <span class="highlight">.mygradient</span> { background: ' + start + color.toRgbString() + ' ' + percents[0] + ', ' + color2.toRgbString() + ' ' + percents[1] + ', ' + color3.toRgbString() + ' ' + percents[2] + ', ' + color4.toRgbString() + ' ' + percents[3] + '); }<br>\n' + '            </div>');
        } else if (coloramount == 5) {
            var color = tinycolor(colors[0]);
            var color2 = tinycolor(colors[1]);
            var color3 = tinycolor(colors[2]);
            var color4 = tinycolor(colors[3]);
            var color5 = tinycolor(colors[4]);
            code = $('<div class="col-lg-12 col-md-12">///// CSS CODES <br>\n' + '                <span class="highlight">.mygradient</span> { background: ' + start + colors[0] + ' ' + percents[0] + ', ' + colors[1] + ' ' + percents[1] + ', ' + colors[2] + ' ' + percents[2] + ', ' + colors[3] + ' ' + percents[3] + ', ' + colors[4] + ' ' + percents[4] + '); }<br>\n' + '                <span class="highlight">.mygradient</span> { background: ' + start + color.toRgbString() + ' ' + percents[0] + ', ' + color2.toRgbString() + ' ' + percents[1] + ', ' + color3.toRgbString() + ' ' + percents[2] + ', ' + color4.toRgbString() + ' ' + percents[3] + ', ' + color5.toRgbString() + ' ' + percents[4] + '); }<br>\n' + '            </div>');
        }

        $('.color-codes').html(code);
    }
});

/***/ })

/******/ });