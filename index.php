<?php
require "includes/config.php";
require "includes/header.php";
?>
<div class=".pageHeader__login">
<?php
if(isset($_POST["logInUser"]))
{
    $login = $_POST["login"];
    $password = $_POST["password"];
    $user->logIn($login, $password);
    $_POST = array();
}

/*if(isset($_SESSION['error']))
{
    echo $_SESSION['error'];
    unset($_SESSION['error']); //trzeba znaleźć miejsce na to xd
}*/

if(isset($_POST["logout"]))
{
    session_destroy();
    header('Location: http://'.$_SERVER["HTTP_HOST"].$_SERVER['REQUEST_URI']);
}

if(!$user->isLogged())
{
?>
<form class=".login" action="" method="post">
    <table cellspacing="0" role="presentation">
        <tbody class=".login__fields" >
            <tr class=".login__fields--titleFields">
                <td class=".mainField">
                    <label for="email">Username or email address</label>
                </td>
                <td class=".mainField">
                    <label for="pass">Password</label>
                </td>
            </tr>
            <tr class=".login__fields--inputFields">
                <td class=".field">
                    <input type="text" class=".inputtext" name="login" id="user" tabindex="1" data-error="Please fill field">
                </td>
                <td class=".field">
                    <input type="password" class=".inputtext" name="password" id="pass" tabindex="2" data-error="Please fill field">
                </td>
                <td class=".field">
                    <label class=".button" id="loginButton">
                        <input value="Login" aria-label="login" tabindex="4" type="submit" name="logInUser">
                    </label>
                </td>
            </tr>
            <tr class=".login__fields--other">
                <td class=".field"></td>
                <td class=".field">
                    <div>
                        <a href="#">Forgot password?</a>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</form>
<?php
}
else
{
    echo "Zalogowany!";
    echo "<form action='' method='post'><input type='submit' value='WYLOGUJ!'' name='logout'></form>";
}
?>
</div>
<main>
    <section class=".sectionHeader">
        <div class=".sectionHeader__slider">
            <div class=".sectionHeader__slider--prev scrollButton"></div>
            <div class=".sectionHeader__slider--photos">
                <img src="img/jpg/slider1.jpg">
            </div>
            <div class=".sectionHeader__slider--next scrollButton"></div>
        </div>
        <div class=".sectionHeader__appDescription">
            <div class=".sectionHeader__appDescription--joinUS">
                <h3>Join Us</h3>
                    <label class=".button" id="loginButton">
                        <input value="Sing in" aria-label="singIn" type="submit">
                    </label>
            </div>
            <aside class=".sectionHeader__appDescription--aboutApp">
                <p>

                </p>
            </aside>
        </div>
    </section>
</main>
<?php
require "includes/footer.php";
?>