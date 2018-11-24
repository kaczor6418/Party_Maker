<?php
require "includes/config.php";
require "includes/header.php";
?>   
<body>
        <header class="pageHeader">
            <div class="pageHeader__panel">
                <a class="pageHeader__panel--logo" href="index.html" title="go back home">
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
										<label>address email</label>
									</td>
									<td class="field">
										<label>Password</label>
									</td>
								</tr>
								<tr class="login__fields--inputFields row">
									<td class="field">
										<input type="text" class="inputText" name="username" id="username" tabindex="1" data-error="Incorrect username">
									</td>
									<td class="field">
										<input type="password" class="inputText" name="password" id="password" tabindex="2" data-error="Incorrect password">
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
								<a href="signUp.html">
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