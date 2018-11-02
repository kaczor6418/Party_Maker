<?php
require "includes/config.php";
if($user->isLogged()){die();}
?>
<!doctype html>

<html lang="en">

    <head>
        <meta charset="utf-8">
        <title> Party Maker </title>
        <meta name="description" content="">
        <meta name="keywords" content="Event, Events, Eventmaker, Make new activities, Activities for children, Activities for family, Activities for elderly, Activities for athletes, Cultural events, Sports events, Music events ,Art events, Education event, Business event, Company events, Party event, Entertainment, Show, Concert, Culture Ceremony, Newest spectacles, Premiere, First Night, Saturday event, Sunday event, Free weekend, Free time, Bored, Nothing to do, Attractions, Attractions in my city, World event , Meeting, Meet up, Meeting with friends, Meeting new people, Scientific meetings">
        <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
        <meta name="viewport" content="width=device-width">
        <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
        <link href="https://fonts.googleapis.com/css?family=Comfortaa:300,400,700&amp;subset=latin-ext" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/signUp.css">
    </head>
<body>
<?php
if(isset($_POST["add_new"]))
{
    $name = $_POST["name"];
    $surname = $_POST["surname"];
    $email = $_POST["email"];
    $birth = $_POST["birdt"];
    $username = $_POST["user"];
    $password = $_POST["pass"];
    $user->signUp($name, $surname, $email, $birth, $username, $password);
    $_POST = array();
}
?>
        <main class="mainBackground">
            <section class="signUp">
                <div class="signUp__wrap">
                    <?php
                    if(isset($_SESSION['error']))
                    {
                        echo $_SESSION['error'];
                        unset($_SESSION['error']); //trzeba znaleźć miejsce na to xd
                    }
                    ?>
                    <form class="signUp__form" action="" method="POST">
                        <table cellspacing="0" role="presentation">
                            <tbody class="form__fields" >
                                <tr class="form__fields--titleFields">
                                    <td class="mainField">
                                        <label >First name :</label>
                                    </td>
                                    <td class="mainField">
                                        <label >Last name :</label>
                                    </td>
                                </tr>
                                <tr class="form__fields--inputFields">
                                    <td class="field">
                                        <input type="text" class="inputtext" name="name" id="name" tabindex="1" data-error="Please give your name!">
                                    </td>
                                    <td class="field">
                                        <input type="text" class="inputtext" name="surname" id="surname" tabindex="2" data-error="Please give your surname!">
                                    </td>
                                </tr>
                                <tr class="form__fields--titleFields">
                                    <td class="mainField">
                                        <label for="email">e-mail :</label>
                                    </td>
                                    <td class="mainField">
                                        <label >Birth date :</label>
                                    </td>
                                </tr>
                                <tr class="form__fields--inputFields">
                                    <td class="field">
                                        <input type="email" class="inputtext" name="email" id="email" tabindex="3" data-error="Please give your email!">
                                    </td>
                                    <td class="field">
                                        <input type="text" class="inputtext" name="birdt" id="birdt" tabindex="4" data-error="Please give your birth date!">
                                    </td>
                                </tr>
                                <tr class="form__fields--titleFields">
                                    <td class="mainField">
                                        <label >Username :</label>
                                    </td>
                                    <td class="mainField">
                                        <label >Password :</label>
                                    </td>
                                </tr>
                                <tr class="form__fields--inputFields">
                                    <td class="field">
                                        <input type="text" class="inputtext" name="user" id="user" tabindex="5" data-error="Please give your username!">
                                    </td>
                                    <td class="field">
                                        <input type="password" class="inputtext" name="pass" id="pass" tabindex="6" data-error="Please give your password  !">
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>
                                        <label id="signUpButton">
                                            <input class="signUpButton button " value="Sign up" aria-label="signUp" type="submit" name="add_new">
                                        </label>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </form>
                    <div class="signUp__logo">
                        <picture class="signUp__logo--img">
                            <a href="index.php" title="go back home">
                                <img class="logo" src="img/png/logo.png">
                            </a>
                        </picture>
                </div>
            </section>
        </main>
    </body>
</html>