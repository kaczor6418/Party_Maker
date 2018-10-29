<?php
require "includes/config.php";
require "includes/header.php";
?>
        <div class="pageHeader__panel--login">
            <?php
            if(isset($_POST["logInUser"]))
            {
                $login = $_POST["username"];
                $password = $_POST["password"];
                $user->logIn($login, $password);
                $_POST = array();
            }

            if(isset($_SESSION['error']))
            {
                echo $_SESSION['error'];
                unset($_SESSION['error']); //trzeba znaleźć miejsce na to xd
            }

            if(isset($_POST["logout"]))
            {
                session_destroy();
                header('Location: http://'.$_SERVER["HTTP_HOST"].$_SERVER['REQUEST_URI']);
            }

            if(!$user->isLogged())
            {
            ?>
            <form class="login" action="" method="post">
                <table cellspacing="0" role="presentation">
                    <tbody class="login__fields" >
                        <tr class="login__fields--titleFields row">
                            <td class="field">
                                <label>Username or</label>
                                <br/>
                                <label>address email</label>
                            </td>
                            <td class="field">
                                <label for="pass">Password</label>
                            </td>
                        </tr>
                        <tr class="login__fields--inputFields row">
                            <td class="field">
                                <input type="text" class="inputtext" name="username" id="user" tabindex="1" data-error="Please fill field">
                            </td>
                            <td class="field">
                                <input type="password" class="inputtext" name="password" id="pass" tabindex="2" data-error="Please fill field">
                            </td>
                            <td class="field">
                                    <input class="button submitButton" value="Login" aria-label="login" tabindex="4" type="submit" name="logInUser">
                            </td>
                        </tr>
                        <tr class="login__fields--other row">
                            <td class="field"></td>
                            <td class="field">
                                <div>
                                    <a href="#"><b>Forgot password?</b></a>
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
                $profile = $user->data();
                echo "Witaj ".$profile['login']."!";
                echo "<form action='' method='post'><input type='submit' value='WYLOGUJ!'' name='logout'></form>";
            }
            ?>
        </div>
    </div>
</header>
<main class="main">
    <section class="sectionHeader">
            <div class="sectionHeader__slider">
                <div class="sectionHeader__slider--prev scrollButton"><br>&#9664;</div>
                <picture class="sectionHeader__slider--photos">
                    <img src="img/jpg/slider1.jpg">
                </picture>
                <div class="sectionHeader__slider--next scrollButton"><br>&#9654;</div>
            </div>
            <div class="sectionHeader__appDescription">
                <div class="sectionHeader__appDescription--joinUS">
                    <h2>Join Us</h2>
                        <label id="singUp">
                            <a href="signup.php">
                                <input class="singUpButton button " value="Sing up" aria-label="signUp" type="submit">
                            </a>
                        </label>
                </div>
                <aside class="sectionHeader__appDescription--aboutApp">
                    <p>
                        Are you looking for interesting events in your city? Or maybe you are a organizer, who wants to promote a new event? Our goal is to gather and present you the most interesting of them. Event Maker is a free application that allows you to find or organize new cultural events or to book tickets for the next match of your favourite sports team. If you don’t have an idea for the weekend free time, take a look at our website and check out what is noteworthy in your local area. See ya on the next event!
                    </p>
                </aside>
            </div>
    </section>
</main>
<?php
require "includes/footer.php";
?>