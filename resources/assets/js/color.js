$(document).ready(function() {
    $('.wheel-picker').wheelColorPicker({
        sliders: "w",
        layout: "block",
        autoResize: false

    });
    var editable = false;

    /// if creating new palette
    $('.paleta').ready(function () {
        if(window.location.pathname=='/color'){
            editable = true;
            $('.edit').addClass('hidden');
            $('.creator').html(" ");
            $('.glyphicon-floppy-saved').removeClass('sort-hidden');
            $('.color-title').attr("readonly", false);
            $('.palete-title').attr("readonly", false);
            $('.palete-title').focus();
            $( ".slider" ).slider( "enable" );
            $('.picker').removeClass('disabled');
            $('.likes').addClass('hidden');
            $('.views').addClass('hidden');
            $('.likeheart').addClass('hidden');
            $('.comment-wrapper').addClass('hidden');

        }
    });


    //fix comments lenghts
    $('.comments').show(function () {
        $('.comment-text').each(function () {
            var ruler = $("<span>" + $(this).html() + "</span>").css({
                'position'    : 'absolute',
                'white-space' : 'nowrap',
                'visibility'  : 'hidden'
            }).css("font", $(this).css("font"));

            // Render ruler, measure, then remove
            $("body").append(ruler);
            var w = ruler.width();
            ruler.remove();
            w=w+($(this).innerWidth() - $(this).width());

            $(this).closest('.single-comment').width(w)
        })
    });


    ///TABS
    ///////
    //////
    ////
    ///
    //

    linkTabs();

    function linkTabs() {
        $(".tabs-link").each(
            function (uniqueindex) {
                $(this).attr('target', 'tab-' + uniqueindex);
            }
        );
        $(".link").each(
            function (uniqueindex) {
                $(this).attr('id', 'tab-' + uniqueindex);
            }
        );
    }


    //Switch tabs
    $('.paleta').on("click", '.tabs-link', function () {
        var target = $(this).attr('target');
        updateHSLSliders($(this).closest('.color'));
        updateRGBSliders($(this).closest('.color'));
        $(this).closest('.color').find(".link").each(function () {
            $(this).addClass('hidden');
        })
        $(this).closest('.color').find("#" + target).removeClass('hidden');
        $(this).closest('.color').find(".tabs-link").each(function () {
            $(this).removeClass('active-tab');
        })
        $(this).addClass('active-tab');

    })

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
            slide: function (event, ui) {
                var value = ui.value;
                $(this).siblings('.value').text(value);
                movedRGBSlider(this, value);
            }
        });

        $(".percent-slider").slider({
            min: 0,
            max: 100,
            step: 1,
            slide: function (event, ui) {
                var value = ui.value;
                $(this).siblings('.value').text(value + '%');
                movedHSLSlider(this, value);
            }
        });

        $(".hue-slider").slider({
            min: 0,
            max: 360,
            step: 1,
            slide: function (event, ui) {
                var value = ui.value;
                $(this).siblings('.value').text(value);
                movedHSLSlider(this);
            }
        });
    }
    switchOnSliders();
    $( ".rgb-slider" ).slider( "disable" );
    $( ".hue-slider" ).slider( "disable" );
    $( ".percent-slider" ).slider( "disable" );


    function movedRGBSlider(slider){
        if ($(slider).hasClass('rgb-r-slider') || $(slider).hasClass('rgb-g-slider') || $(slider).hasClass('rgb-b-slider')){
            var r = $(slider).closest('.color').find('.rgb-r').text();
            var g = $(slider).closest('.color').find('.rgb-g').text();
            var b = $(slider).closest('.color').find('.rgb-b').text();
            var color = rgbToHex(r,g,b);
            changeColor($(slider).closest('.color'),color);
        }
    }





    function movedHSLSlider(slider){
        if ($(slider).hasClass('hsl-h-slider') || $(slider).hasClass('hsl-s-slider') || $(slider).hasClass('hsl-l-slider')){
            var h = $(slider).closest('.color').find('.hsl-h').text();
            var s = $(slider).closest('.color').find('.hsl-s').text();
            var l = $(slider).closest('.color').find('.hsl-l').text();
            var color = hsl2rgb(h,s,l);
            var color1=rgbToHex(color.r,color.g,color.b);
            changeColor($(slider).closest('.color'),color1);
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


    $( '.paleta' ).disableSelection();


    //Match form names after sorting
    function matchNames(){
        $( ".color-title" ).each(function(index){
            index=index+1;
            $(this).attr('name','color'+index);
        });
    }


    //CLICK ON COLOR / ACTIVATE
    var clickDisabled = false;
    var sortable = false;
    $('.paleta').on('click','.color', function(event) {

        if (clickDisabled || $(event.target).is('.glyphicon'))
        {return;}
        $('.color').removeClass('active');
        $(this).addClass('active');


    });

    //Edit palette
    $('.edit').click(function(){
        editable = true;
        $('.edit').addClass('hidden');
        $('.creator').html(" ");
        $('.glyphicon-floppy-saved').removeClass('sort-hidden');
        $('.color-title').attr("readonly", false);
        $('.palete-title').attr("readonly", false);
        $('.palete-title').focus();
        $( ".slider" ).slider( "enable" );
        $('.picker').removeClass('disabled');
        $('.likes').addClass('hidden');
        $('.views').addClass('hidden');
        $('.likeheart').addClass('hidden');
        $('.comment-wrapper').addClass('hidden');

    });

    //Finish edit palete title with enter
    $('.paleta').on('keypress','.palete-title',function(e){
        if(e.which == 13){
            e.preventDefault();
            $(this).blur();
        }
    });





    //like
    $('.paleta').on('click', '.glyphicon', function() {
        if ($(this).hasClass('glyphicon-heart-empty')){
            $(this).removeClass('glyphicon-heart-empty');
            $(this).addClass('glyphicon-heart');
        }
        else if ($(this).hasClass('glyphicon-heart')){
            $(this).removeClass('glyphicon-heart');
            $(this).addClass('glyphicon-heart-empty');

        }
    });



    //Check for colors amount on start and change .color background
    $('.paleta').show(function(){
        $( ".color" ).each(function(index){
            changeColor($(this), $(this).find('.color-title').val())
            updateRGBSliders($(this));
            updateHSLSliders($(this));
        });
    });


    //submit form
    $('.save').click(function(){
        document.paletaForm.submit()

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

    $('.paleta').on('slidermove','.wheel-picker', function(){
        colorPickerUsed($(this))
    });
    $('.paleta').on('sliderup','.wheel-picker', function(){
        colorPickerUsed($(this))
    });

    function colorPickerUsed(picker) {
        var color = picker.wheelColorPicker('value');
        colorhex = "#"+color;
        changeColor(picker.closest('.color'),colorhex);
        updateHSLSliders(picker.closest('.color'),colorhex);
        updateRGBSliders(picker.closest('.color'),colorhex);
    }

    function updateColorPicker(picker,color) {
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
    $('.paleta').on('focus','.color-title',function(){
        lastcolor = $(this).val();
    });

    //Finish edit color-title with enter
    $('.paleta').on('keypress','.color-title',function(e){
        if(e.which == 13){
            e.preventDefault();
            $(this).blur();
        }
    });


    //Check if color-title value matches hex
    $('.paleta').on('focusout','.color-title',function(){
        var alphaExp = /^#[0-9a-fA-F]{6}$/;
        if ($(this).val().match(alphaExp) && $(this).val()!==lastcolor){
            changeColor($(this).closest('.color'), $(this).val())
            updateRGBSliders($(this).closest('.color'))
            updateHSLSliders($(this).closest('.color'))

        }else{
            $(this).val(lastcolor);
        }
    });

    function updateRGBSliders(object){
        var colorhex = object.find(".color-title").val();
        object.find('.rgb-r').text(hexToRgb(colorhex).r);
        object.find('.rgb-r-slider').children().first().children().first().css('left', hexToRgb(colorhex).r * 100 / 255 +"%");

        object.find('.rgb-g').text(hexToRgb(colorhex).g);
        object.find('.rgb-g-slider').children().first().children().first().css('left', hexToRgb(colorhex).g * 100 / 255 +"%");

        object.find('.rgb-b').text(hexToRgb(colorhex).b);
        object.find('.rgb-b-slider').children().first().children().first().css('left', hexToRgb(colorhex).b * 100 / 255 +"%");
    }

    function updateHSLSliders(object) {
        var colorhex = object.find(".color-title").val();
        object.find('.hsl-h').text(hexToHsl(colorhex).H);
        object.find('.hsl-h-slider').children().first().children().first().css('left', hexToHsl(colorhex).H/360*100  +"%");

        object.find('.hsl-s').text(hexToHsl(colorhex).S+'%');
        object.find('.hsl-s-slider').children().first().children().first().css('left', hexToHsl(colorhex).S  +"%");

        object.find('.hsl-l').text(hexToHsl(colorhex).L+'%');
        object.find('.hsl-l-slider').children().first().children().first().css('left', hexToHsl(colorhex).L +"%");


    }

    function changeColor(object, colorhex){

        //change .color-title value
        object.find('.color-title').val(colorhex);

        //update color picker value
        var picker = object.find('.wheel-picker')
        updateColorPicker(picker,colorhex);

        //update hsl saturation and iluminancy slider
        object.find('.hsl-s-slider').css('background',"linear-gradient(to right, hsla(0,0%,50%,1) 0%, hsla("+hexToHsl(colorhex).H+",100%,50%,1) 100%)");
        object.find('.hsl-l-slider').css('background',"linear-gradient(to right, hsla(0,0%,0%,1) 0%, hsla("+hexToHsl(colorhex).H+",100%,50%,1) 50%,hsla(0,0%,100%,1) 100%)");

        //change .color background-color
        object.css("background-color", colorhex);

        //calculate iluminancy and change fonts
        var hsl=rgbToHsl(hexToRgb(colorhex).r,hexToRgb(colorhex).g,hexToRgb(colorhex).b);
        if (hsl[2]>0.7){
            object.css("color", 'black');
        }
        else if (hsl[2]<=0.7){
            object.css("color", 'white');
        }

        //initiate background gradient change to match new color
        changeBackgroundColor();
    }

    //
    ///
    ////
    /////
    //////
    ///////






    function changeBackgroundColor(){

        var colors = [];
        $( ".color-title" ).each(function(index){
            colors[index]='#F4F4F4';
        });
        var coloramount = colors.length;

        if(coloramount==1){
            $("body").css("background",colors[0]);
        }
        else if(coloramount==2){
            $("body").css("background",'linear-gradient(to bottom, '+colors[0]+' 0%,'+colors[1]+' 100%)');
        }
        else if(coloramount==3){
            $("body").css("background",'linear-gradient(to bottom, '+colors[0]+' 0%,'+colors[1]+' 50%,'+colors[2]+' 100%)');
        }
        else if(coloramount==4){
            $("body").css("background",'linear-gradient(to bottom, '+colors[0]+' 0%,'+colors[1]+' 33%,'+colors[2]+' 66%,'+colors[3]+' 100%)');
        }
        else if(coloramount==5){
            $("body").css("background",'linear-gradient(to bottom, '+colors[0]+' 0%,'+colors[1]+' 25%,'+colors[2]+' 50%,'+colors[3]+' 75%,'+colors[4]+' 100%)');
        }

        changeFontsColor(colors);
    }

    function changeFontsColor(colors) {

        var coloramount = colors.length;
        if(coloramount==1){
            var hsl=rgbToHsl(hexToRgb(colors[0]).r,hexToRgb(colors[0]).g,hexToRgb(colors[0]).b);
            if (hsl[2]>0.7){
                $('body').css("color", 'black');
                $('.nav-icon4 span').css('background-color','black');
            }
            else if (hsl[2]<=0.7){
                $('body').css("color", 'white');
                $('.nav-icon4 span').css('background-color','white');
            }
        }
        else if(coloramount>=2){
            var hsl=rgbToHsl(hexToRgb(colors[0]).r,hexToRgb(colors[0]).g,hexToRgb(colors[0]).b);
            var hsl2=rgbToHsl(hexToRgb(colors[1]).r,hexToRgb(colors[1]).g,hexToRgb(colors[1]).b);
            if (hsl[2]>0.7 || hsl2[2]>0.7){
                $('body').css("color", 'black');
                $('.nav-icon4 span').css('background-color','black');
            }
            else if (hsl[2]<=0.7 && hsl2[2]<=0.7){
                $('body').css("color", 'white');
                $('.nav-icon4 span').css('background-color','white');
            }

        }


    }


    ///Manage comments


    $('.newcomment').click(function (e) {
        var whitespace = new RegExp('^\\s*$');
        if (!whitespace.test($('#newcomment_text').val())) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            })

            e.preventDefault();

            var formData = {
                text: $('#newcomment_text').val(),
                color_id: $('#palette_id').val(),
            }


            var comment=$('<div class="single-comment">\n' +
                '                <input class="comment-id hidden" value="cikos">\n' +
                '                <div class="user-comment">\n' +
                '\n' +
                '                    <div class="nameandlogo">\n' +
                '                        <div class="userlogo smalllogo">\n' +
                '                            <span class="glyphicon glyphicon-user"></span>\n' +
                '                        </div>\n' +
                '                        <div class="user-name">'+$('#user_name').html()+'</div>\n' +
                '                    </div>\n' +
                '\n' +
                '                    <div class="dateandcontrols">\n' +
                '\n' +
                '                        <div class="comment-time">just now</div>\n' +
                '                    </div>\n' +
                '\n' +
                '\n' +
                '                </div>\n' +
                '                <div class="comment-text">'+$('#newcomment_text').val()+'</div>\n' +
                '            </div>');


            $('.comments').append(comment);

            var ruler = $("<span>" + $(comment).find('.comment-text').html() + "</span>").css({
                'position'    : 'absolute',
                'white-space' : 'nowrap',
                'visibility'  : 'hidden'
            }).css("font", $(this).css("font"));

            // Render ruler, measure, then remove
            $("body").append(ruler);
            var w = ruler.width();
            ruler.remove();
            w=w+2*($(this).innerWidth() - $(this).width())+20;

            $(comment).width(w);
            var id = $(comment).find('.comment-id');

            $.ajax({

                type: 'POST',
                url: '/ccomments/new',
                data: formData,
                dataType: 'json',
                success: function (data) {
                    console.log(data.data);
                    id.attr("value",data.data);
                    var trash = $('<span class="trash glyphicon glyphicon-trash comment-icon deletecomment"></span>\n');
                    $(comment).find('.dateandcontrols').append(trash);
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });


            $('#newcomment_text').val("");




        }else{
            $('#newcomment_text').val("");
            $('#newcomment_text').attr("placeholder","Napisz swój komentarz zanim go dodasz")
        }
    })

    $('body').on('click', '.deletecomment', function(e) {
        e.preventDefault();
        if (confirm("Do you realy want to delete comment?") == true) {
            //OK
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            })

            var comment_id = $(this).closest('.single-comment').find('.comment-id').val();
            $(this).closest('.single-comment').remove();

            $.ajax({
                type: 'DELETE',
                url: '/ccomments/'+comment_id,
                success: function (data) {
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });


        }

    });


});
