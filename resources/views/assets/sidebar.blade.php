
<div class="sidemenu-shown sidemenu-hidden">
    <div class="sidemenu-bar logo onlydesktop"><a href="/" >Pickolor</a></div>
    <div class="userlogo">
        <span class="glyphicon glyphicon-user"></span>
    </div>
    @if (!Auth::check())
    <div class="sidemenu-bar"><a class="thick" href="/login">sign in </a>/<a class="thick" href="/register"> sign up</a></div>
    @else
        <div id="user_name" class="sidemenu-bar thick">{{Auth::user()->name}}</div>
        <div class="sidemenu-bar"><a href="/logout">logout</a></div>
    @endif
    <div class="sidemenu-bar side-menu-link onlymobile"><a href="/palettes/all" >Palets</a></div>
    <div class="sidemenu-bar side-menu-link onlymobile"><a href="/colors/all" >Colors</a></div>
    <div class="sidemenu-bar side-menu-link onlymobile"><a href="#" >Gradients</a></div>

    @if (!Request::is("color/*") and !Request::is("palette/*") and !Request::is("palette") and !Request::is("color"))

        <div class="css-switch-wrapper othercss">
            <div class="css-switch-holder">
                <div class="css-switch">normal</div>
                <div class="css-switch-circle"></div>
                <div class="css-switch">dark</div>
            </div>
        </div>
    @endif
</div>