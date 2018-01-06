@if (auth()->check())

    <div class="chat-wrapper" style="height: 30px">
        <div class="chat-header"> CHAT</div>
        <div id = "chat-main" class="chat-main">

            <div class="msg">
                {{--<div class="msg-time">3:30</div>--}}
                <div class="msg-author">gtluszcz:</div>
                <div class="msg-body"> Lel you funny :D</div>
            </div>


        </div>
        <div class="chat-new-wrapper">
            <input class="new-msg" placeholder="type something here">
            <div class="new-msg-button glyphicon glyphicon-ok"></div>
        </div>
    </div>



@endif