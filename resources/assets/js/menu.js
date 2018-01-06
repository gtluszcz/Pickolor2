$(document).ready(function() {

    ///SIDE MENU
    ///////
    //////
    ////
    ///
    //

    //open sidemenu
    $('.nav-icon4').click(function () {
        $('.nav-icon4').toggleClass('open');
        $('.sidemenu-shown').toggleClass('sidemenu-hidden');
        $('.container-fluid').toggleClass('container-fluid-squezed');
    });

    //
    ///
    ////
    /////
    //////
    ///////

    ///CHAT
    ///////
    //////
    ////
    ///
    //
    $( ".chat-wrapper" ).resizable({
        handles: "n, e, w",
        minHeight: 30,
        minWidth: 200,
        maxHeight: $(window).height(),
        maxWidth: $(window).width(),
    });
    $( ".chat-wrapper" ).draggable({
        snap: true,
        snapMode: "inner",
        containment: "body",
        axis: "x"
    });

    var scrolled = false;

    function updateScroll(){
        var element = document.getElementById("chat-main");
        if (element.scrollTop >= element.scrollHeight - $('#chat-main').height() - 28) {
            element.scrollTop = element.scrollHeight;
        }
    }


    $('.chat-header').click(function () {
        var $win = $(window);
        var winH = $win.height();
        if ($('.chat-wrapper').height() > 30){
            $('.chat-wrapper').height(30);
            $('.chat-wrapper').css("top",winH -30);
        }
        else{
            $('.chat-wrapper').height(270);
            $('.chat-wrapper').css("top",winH -270);
        }

    })

    $('.chat-main').show(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        })


        var chat = $('.chat-main');
        $.ajax({

            type: 'POST',
            url: '/chat/refresh',
            success: function (data) {

                chat.html(" ");
                data.data.forEach(function (element) {
                    chatinput=$(' <div class="msg">\n' +
                        '                <div class="msg-author">'+element.user+':</div>\n' +
                        '                <div class="msg-body">'+element.text+'</div>\n' +
                        '            </div>');
                    chat.append(chatinput);
                })
                var element = document.getElementById("chat-main");
                element.scrollTop = element.scrollHeight;

            },
            error: function (data) {
                console.log('Error:', data);
            }
        });

    })

    function newmsg() {
        var whitespace = new RegExp('^\\s*$');
        if (!whitespace.test($('.new-msg').val())) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            })


            var formData = {
                text: $('.new-msg').val(),
            }


            var chat = $('.chat-main');

            $.ajax({

                type: 'POST',
                url: '/chat/new',
                data: formData,
                dataType: 'json',
                success: function (data) {

                    chat.html(" ");
                    data.data.forEach(function (element) {
                        chatinput=$(' <div class="msg">\n' +
                            '                <div class="msg-author">'+element.user+':</div>\n' +
                            '                <div class="msg-body">'+element.text+'</div>\n' +
                            '            </div>');
                        chat.append(chatinput);
                    })
                    var element = document.getElementById("chat-main");
                    element.scrollTop = element.scrollHeight;


                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });


            $('.new-msg').val("");
            $('.new-msg').attr("placeholder","type something here");



        }else{
            $('.new-msg').val("");
            $('.new-msg').attr("placeholder","write a message");
        }

    }

    $('.new-msg-button').click(function () {
        newmsg();
    })

    $('body').on('keypress','.new-msg',function(e){
        if(e.which == 13){
            e.preventDefault();
            newmsg();
            $(this).blur();
        }
    });

    function refreshchat() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        })


        var chat = $('.chat-main');
        $.ajax({

            type: 'POST',
            url: '/chat/refresh',
            success: function (data) {

                chat.html(" ");
                data.data.forEach(function (element) {
                    chatinput=$(' <div class="msg">\n' +
                        '                <div class="msg-author">'+element.user+':</div>\n' +
                        '                <div class="msg-body">'+element.text+'</div>\n' +
                        '            </div>');
                    chat.append(chatinput);
                })
                updateScroll();

            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    }

    if ( $('#user_name').html()!=null ){
        setInterval(refreshchat, 500);
    }

    //
    ///
    ////
    /////
    //////
    ///////


    ///CSS SWITCH
    ///////
    //////
    ////
    ///
    //
    var other_css=false;

    $('body').ready(function () {
        if (localStorage.getItem("css_other") === null) {
            localStorage.setItem('css_other', 'false');
        }
        if (localStorage.getItem("css_other")=="true"){
            toggleothercss();
        }
    })



    var css_other_path = "../css/dark.css";


    //click on button
    $('.othercss').click(function () {
        toggleothercss();
    });

    function toggleothercss() {
        $('.css-switch-holder').toggleClass('css-switch-other');
        other_css = !other_css;
        localStorage.setItem('css_other', other_css);
        if (other_css){
            $('#css_other').attr("href",css_other_path);
        }
        else {
            $('#css_other').attr("href"," ");
        }
    }

    //
    ///
    ////
    /////
    //////
    ///////

});

