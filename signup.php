<?php
require 'includes/header.php';
?>
	<body>
        <main class="mainBackground">
            <section class="signUp">
                <div class="signUp__wrap">
                    <form action="validationEngine.php" method="post" class="signUp__form">
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
                                        <input type="text" class="inputText" name="name" id="name" tabindex="1" data-error="Enter name!">
                                    </td>
                                    <td class="field">
                                        <input type="text" class="inputText" name="surname" id="surname" tabindex="2" data-error="Enter surname!">
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
                                        <input type="email" class="inputText" name="email" id="email" tabindex="3" data-error="Enter your email!">
                                    </td>
                                    <td class="field">
                                        <input type="text" class="inputText" name="birthDate" id="birthDate" tabindex="4" data-error="Enter birth date!">
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
                                        <input type="text" class="inputText" name="username" id="username" tabindex="5" data-error="Enter username!">
                                    </td>
                                    <td class="field">
                                        <input type="password" class="inputText" name="password" id="password" tabindex="6" data-error="Enter password!">
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>
                                        <label id="signUpButton">
                                            <input class="signUpButton button" name="signUp" value="Sign up" aria-label="signUp" type="submit">
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
                </div>
            </section>
        </main>
        <script src="js/scripts/signUp.js" type="module"></script>
    </body>
</html>