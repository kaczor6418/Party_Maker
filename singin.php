<?php
require "includes/config.php";
if($user->isLogged()){die();}
require "includes/header.php";
?>
</header>
<main>
<?php
if(isset($_POST["add_new"]))
{
    $name = $_POST["name"];
    $surname = $_POST["surname"];
    $email = $_POST["email"];
    $birth = $_POST["birdt"];
    $username = $_POST["user"];
    $password = $_POST["pass"];
    $user->singIn($name, $surname, $email, $birth, $username, $password);
    $_POST = array();
}

if(isset($_SESSION['error']))
{
    echo $_SESSION['error'];
    unset($_SESSION['error']); //trzeba znaleźć miejsce na to xd
}
?>
    <section class=".singIn">
        <div class=".singIn__form">
            <form class=".singIn" action="" method="post">
                <table cellspacing="0" role="presentation">
                    <tbody class=".singIn__fields" >
                        <tr class=".singIn__fields--titleFields">
                            <td class=".mainField">
                                <label for="text">First name :</label>
                            </td>
                            <td class=".mainField">
                                <label for="text">Last name :</label>
                            </td>
                        </tr>
                        <tr class=".singIn__fields--inputFields">
                            <td class=".field">
                                <input type="text" class=".inputtext" name="name" id="name" tabindex="1" data-error="Please give your name!">
                            </td>
                            <td class=".field">
                                <input type="text" class=".inputtext" name="surname" id="surname" tabindex="2" data-error="Please give your surname!">
                            </td>
                        </tr>
                        <tr class=".singIn__fields--titleFields">
                            <td class=".mainField">
                                <label for="email">e-mail :</label>
                            </td>
                            <td class=".mainField">
                                <label for="text">Birth date :</label>
                            </td>
                        </tr>
                        <tr class=".singIn__fields--inputFields">
                            <td class=".field">
                                <input type="email" class=".inputtext" name="email" id="email" tabindex="1" data-error="Please give your email!">
                            </td>
                            <td class=".field">
                                <input type="text" class=".inputtext" name="birdt" id="birdt" tabindex="2" data-error="Please give your birth date!">
                            </td>
                        </tr>
                        <tr class=".singIn__fields--titleFields">
                            <td class=".mainField">
                                <label for="text">Username :</label>
                            </td>
                            <td class=".mainField">
                                <label for="password">Password :</label>
                            </td>
                        </tr>
                        <tr class=".singIn__fields--inputFields">
                            <td class=".field">
                                <input type="text" class=".inputtext" name="user" id="user" tabindex="1" data-error="Please give your username!">
                            </td>
                            <td class=".field">
                                <input type="password" class=".inputtext" name="pass" id="pass" tabindex="2" data-error="Please give your password  !">
                            </td>
                        </tr>
                        <tr class=".singIn__fields--submitField">
                            <td class=".field"></td>
                            <td class=".field"></td>
                            <td class=".field"></td>
                            <td class=".field">
                                <label class=".button" id="singInButton">
                                    <input value="Sing in" aria-label="singIn" tabindex="3" type="submit" name="add_new">
                                </label>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>
        </div>
        <div class=".singIn__google">
            <h2>Or</h2>
            <div>
                <p>
                    <b>Sing in with </b>
                    <i class="fab fa-google-plus-g fa-lg"></i>
                </p>
            </div>
        </div>
    </section>
</main>
<?php
require "includes/footer.php";
?>