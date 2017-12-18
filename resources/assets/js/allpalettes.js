$(document).ready(function() {


    $('body').on('click', '.heart', function(e) {
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        })

        var palette_id = $(this).parent().parent().find('.id').val();

        if ($(this).hasClass('glyphicon-heart-empty')){
            //LIKE
            $(this).removeClass('glyphicon-heart-empty');
            $(this).addClass('glyphicon-heart');

            var likes = $(this).closest('.single-palett-wrapper').find('.likes-nr').html();
            $(this).closest('.single-palett-wrapper').find('.likes-nr').html(likes-(-1));

            var type = "POST";


        }
        else if ($(this).hasClass('glyphicon-heart')){
            //UNLIKE
            $(this).removeClass('glyphicon-heart');
            $(this).addClass('glyphicon-heart-empty');
            if(window.location.pathname=='/palettes/favourite'){
                $(this).closest('.single-palett-wrapper').remove();
            }
            var likes = $(this).closest('.single-palett-wrapper').find('.likes-nr').html();
            $(this).closest('.single-palett-wrapper').find('.likes-nr').html(likes-1);

            var type = "DELETE";

        }

        $.ajax({
            type: type,
            url: '/like/'+palette_id,
            success: function (data) {
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });

    });

    $('body').on('click', '.trash', function(e) {
        e.preventDefault();
        if (confirm("Do you realy want to delete palette?") == true) {
            //OK
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            })

            var palette_id = $(this).parent().parent().find('.id').val();
            $(this).closest('.single-palett-wrapper').remove();

            $.ajax({
                type: 'DELETE',
                url: '/palette/'+palette_id,
                success: function (data) {
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });


        }

    });








});