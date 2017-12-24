$(document).ready(function() {


    $('body').on('click', '.heart', function(e) {
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        })

        var color_id = $(this).parent().find('.color-id').html();

        if ($(this).hasClass('glyphicon-heart-empty')){
            //LIKE
            $(this).removeClass('glyphicon-heart-empty');
            $(this).addClass('glyphicon-heart');


            var type = "POST";


        }
        else if ($(this).hasClass('glyphicon-heart')){
            //UNLIKE
            $(this).removeClass('glyphicon-heart');
            $(this).addClass('glyphicon-heart-empty');
            if(window.location.pathname=='/colors/favourite'){
                $(this).closest('.palette-colors').remove();
            }
            var type = "DELETE";

        }

        $.ajax({
            type: type,
            url: '/likecolor/'+color_id,
            success: function (data) {
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });

    });



    $('.palettes-wrapper').ready(function () {
        $('.color-title').each(function () {

            var color = $(this).html();

            var hsl=rgbToHsl(hexToRgb(color).r,hexToRgb(color).g,hexToRgb(color).b);
            if (hsl[2]>0.7){
                $(this).css("color", 'black');
                $(this).parent().find('.heart').css("color", 'black');

            }
            else if (hsl[2]<=0.7){
                $(this).css("color", 'white');
                $(this).parent().find('.heart').css("color", 'white');

            }

        })
    })








});