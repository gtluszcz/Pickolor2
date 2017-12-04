<main class="nonlogin-wrapper">
    <h1 class="register-logo"><img src="img/loga.png" alt="logo"><span>What Up To</span></h1>
    <div class="register-wrapper">
        <h2 class="register-title">Create new account</h2>
        <form class="register-form" action="engine/register.php" method="POST">
            <input class="register-field" name="username" type="text" placeholder="Username">
            <input class="register-field" name="email" type="email" placeholder="E-mail">
            <input class="register-field" type="password" name="password" placeholder="Password">
            <input class="register-field" type="password" name="password_r" placeholder="Retype password">
            <button class="register-button" type="submit">Sign up!</button>
        </form>
        <div class="register-link">
            <span>Already own an account? <a href="index.php?action=login">Log In!</a></span>
        </div>
    </div>
</main>