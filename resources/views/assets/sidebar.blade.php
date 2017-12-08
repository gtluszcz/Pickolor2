
<div class="sidemenu-shown sidemenu-hidden">
    <div class="sidemenu-bar logo onlydesktop"><a href="/" >Pickolor</a></div>
    <div class="userlogo">
        <span class="glyphicon glyphicon-user"></span>
    </div>
    @if (!Auth::check())
    <div class="sidemenu-bar"><a class="thick" href="/login">sign in </a>/<a class="thick" href="/register"> sign up</a></div>
    @else
        <div class="sidemenu-bar thick">{{Auth::user()->name}}</div>
        <div class="sidemenu-bar"><a href="/logout">logout</a></div>
    @endif
    <div class="sidemenu-bar side-menu-link onlymobile"><a href="/palettes/all" >Palets</a></div>
    <div class="sidemenu-bar side-menu-link onlymobile"><a href="#" >Colors</a></div>
    <div class="sidemenu-bar side-menu-link onlymobile"><a href="#" >Gradients</a></div>
</div>