<?php

class User
{
	private $connect;

	public function __construct($connect)
	{
		$this->connect = $connect;
	}

	public function isLogged()
	{
		return isset($_SESSION["user_id"]);
	}

	public function singIn($name, $surname, $email, $birth, $username, $password)
	{
		if(empty($name) || empty($surname) || empty($email) || empty($birth) || empty($username) || empty($password))
		{
			$_SESSION['error'] = 'Wypełnij wszystkie pola!<br>';
		}
		else if(strlen($name) < 3 || strlen($surname) < 3)
		{
			$_SESSION['error'] = 'Twoje imię i nazwisko nie mogą mieć mniej niż 3 znaki.<br>';
		}
		else if(!filter_var($email, FILTER_VALIDATE_EMAIL))
		{
			$_SESSION['error'] = 'Podaj poprawny email.<br>';
		}
		else if(strlen($username) < 3)
		{
			$_SESSION['error'] = 'Nazwa użytkownika nie może być krótsza niż 3 znaki.<br>';
		}
		else if(strlen($password) < 8)
		{
			$_SESSION['error'] = 'Twoje hasło musi mieć minimum 8 znaków!<br>';
		}
		else
		{
			$statement = $this->connect->prepare('SELECT id FROM users WHERE login = ?');
			$statement->bind_param('s', $username);
			$statement->execute();
			$result = $statement->get_result();
			if($result)
			{
				if($result->num_rows)
				{
					$_SESSION['error'] = 'Taki użytkownik istnieje w naszym systemie. Zaloguj się!<br>';
				}
				else
				{
					$statement = $this->connect->prepare("INSERT INTO `users` (`id`, `login`, `password`) VALUES (NULL, ?, ?)");
					$passhash = password_hash($password, PASSWORD_DEFAULT);
					$statement->bind_param('ss', $username, $passhash);
					$statement->execute();
					$result = $statement->get_result();
					if($result)
					{
						$_SESSION['error'] = 'Twoje konto zostało utworzone. Zaloguj się!<br>';
					}
				}
			}
		}
	}

	public function logIn($login, $passwordword)
	{
		if(empty($login) || empty($passwordword))
		{
			$_SESSION['error'] = 'Wypełnij wszystkie pola!<br>';
		}
		else
		{
			$statement = $this->connect->prepare('SELECT id, password FROM users WHERE login = ?');
			$statement->bind_param('s', $login);
			$statement->execute();
			$result = $statement->get_result();
			if($result)
			{
				if(!$result->num_rows)
				{
					$_SESSION['error'] = 'Taki użytkownik nie istnieje w naszym systemie. Zarejestruj się!<br>';
				}
				else
				{
					$usernameData = $result->fetch_assoc();

					if(password_verify($passwordword, $usernameData["password"]))
					{
						$_SESSION["user_id"] = $usernameData["id"];
					}
					else
					{
						$_SESSION['error'] = 'Błędny login lub hasło!<br>';
					}
				}
			}
		}
	}
}