<?php
require 'includes/header.php';
?>
	<link rel="stylesheet" href="css/signUp.css">
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
        <main class="mainBackground">
            <section class="signUp">
                <div class="signUp__wrap">
                    <form action="validationEngine.php" method="post" class="signUp__form">
                        <table cellspacing="0" role="presentation">
                            <tbody class="form__fields" >
                                <tr class="form__fields--titleFields">
                                    <td class="mainField">
                                        <label class="beforeInformation" >First name</label>
                                        <i title="Your first name should contains only letters"
                                           class="fas fa-info-circle informationAboutField firstNameInformation"></i>
                                    </td>
                                    <td class="mainField">
                                        <label class="beforeInformation" >Last name</label>
                                        <i title="Your last name should contains only letters"
                                           class="fas fa-info-circle informationAboutField lastNameInformation"></i>
                                    </td>
                                </tr>
                                <tr class="form__fields--inputFields">
                                    <td class="field">
                                        <input type="text" class="inputText" name="firstName" id="firstName" tabindex="1"
                                               data-error="First name is incorrect it should contain min 3 characters)" data-success="Correct first name">
                                    </td>
                                    <td class="field">
                                        <input type="text" class="inputText" name="lastName" id="lastName" tabindex="2"
                                               data-error="Last name is incorrect it (should contain min 3 characters)" data-success="Correct last name">
                                    </td>
                                </tr>
                                <tr class="form__fields--titleFields">
                                    <td class="mainField">
                                        <label class="beforeInformation" title="Enter your email" for="email">e-mail</label>
                                        <i title="Enter your email"
                                           class="fas fa-info-circle informationAboutField emailInformation"></i>
                                    </td>
                                    <td class="mainField">
                                        <label class="beforeInformation" >Birth date</label>
                                        <i title="Enter your birth date (format of your birth date: dd/mm/yyyy)"
                                           class="fas fa-info-circle informationAboutField birthDateInformation"></i>
                                    </td>
                                </tr>
                                <tr class="form__fields--inputFields">
                                    <td class="field">
                                        <input type="email" class="inputText" name="email" id="email" tabindex="3"
                                               data-error="Your email is incorrect" data-success="Correct email">
                                    </td>
                                    <td class="field">
                                        <input type="text" class="inputText" name="birthDate" id="birthDate" tabindex="4"
                                               data-error="Your birth date format should looks like dd/mm/yyyy" data-success="Correct birth date">
                                    </td>
                                </tr>
                                <tr class="form__fields--titleFields">
                                    <td class="mainField">
                                        <label class="beforeInformation" >Username</label>
                                        <i title="Your must contain min 3 letters and it can contain numbers"
                                           class="fas fa-info-circle informationAboutField usernameInformation"></i>
                                    </td>
                                    <td class="mainField">
                                        <label class="beforeInformation" >Password</label>
                                        <i title="Your password must contain min 8 characters min one small letter one big letter one number and one special sign[@$!%*?&#^_]"
                                           class="fas fa-info-circle informationAboutField passwordInformation"></i>
                                    </td>
                                </tr>
                                <tr class="form__fields--inputFields">
                                    <td class="field">
                                        <input type="text" class="inputText" name="username" id="username" tabindex="5"
                                               data-error="Username is incorrect it should contain min 3 characters)" data-success="Correct username">
                                    </td>
                                    <td class="field">
                                        <input type="password" class="inputText" name="password" id="password" tabindex="6"
                                               data-error="Your password should contain min 8 characters min one small letter one big letter one number and one special sign[@$!%*?&#^_]" data-success="Correct password">
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