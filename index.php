<?php
require "includes/config.php";
require "includes/header.php";
?>   
	<link rel="stylesheet" href="css/style.css">
	</head>
	<body>
		<header class="pageHeader">
			<div class="pageHeader__panel">
				<a class="pageHeader__panel--logo" href="index.php" title="go back home">
					<img class="logo" src="img/png/logo.png">
				</a>
				<div class="pageHeader__panel--login">
				<?php
				if(!$user->isLogged())
				{
				?>
				<form action="validationEngine.php" method="post" class="login">
					<table cellspacing="0" role="presentation">
						<tbody class="login__fields" >
							<tr class="login__fields--titleFields row">
								<td class="field">
									<label>Username or</label>
									<br/>
									<label class="beforeInformation">address email</label>
									<i title="Enter your userName or email of your account"
									   class="fas fa-info-circle informationAboutField usernameInformation"></i>
								</td>
								<td class="field">
									<label class="beforeInformation" >Password</label>
									<i title="Enter your password"
									   class="fas fa-info-circle informationAboutField passwordInformation"></i>
								</td>
							</tr>
							<tr class="login__fields--inputFields row">
								<td class="field">
									<input type="text" class="inputText" name="username" id="username" tabindex="1"
										   data-error="Username is incorrect it should contain min 3 characters)" data-success="Correct username">
								</td>
								<td class="field">
									<input type="password" class="inputText" name="password" id="password" tabindex="2"
										   data-error="Your password should contain min 8 characters min one small letter one big letter one number and one special sign[@$!%*?&#^_]" data-success="Correct password">
								</td>
								<td class="field">
										<input class="button loginButton" name="login" value="Login" aria-label="login" tabindex="4" type="submit">
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
				echo "Witaj ".$profile['login']."!<br>";
				echo "<a href='logOut.php'>Wyloguj się!</a>";
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
                            <label>
                                <a href="signUp.php">
                                    <input class="signUpButton button " name="signUp" value="Sign up" aria-label="signUp">
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
		require 'includes/footer.php';
		?>
		<script src="js/scripts/index.js" type="module"></script>
	</body>
</html>