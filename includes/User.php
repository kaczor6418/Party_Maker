<?php
function isDate($string) {
    $matches = array();
    $pattern = '/^([0-9]{1,2})\\/([0-9]{1,2})\\/([0-9]{4})$/';
    if (!preg_match($pattern, $string, $matches)) return false;
    if (!checkdate($matches[2], $matches[1], $matches[3])) return false;
    return true;
}

class User
{
	private $connect;

	public function __construct($connect)
	{
		$this->connect = $connect;
	}

	public function data($idUserToGet = null)
    {
        if ($idUserToGet == null)
        {
        	if(isset($_SESSION['user_id']))
        	{
        		$idUserToGet = $_SESSION['user_id'];
        		$statement = $this->connect->prepare('UPDATE `users` SET lastActive = NOW() WHERE user_id = ?');
				$statement->bind_param('i', $idUserToGet);
				$statement->execute();
        	}
        	else
        	{
        		echo "Użytkownik nie jest zalogowany!";
        	}
        }
    	$statement = $this->connect->prepare('SELECT user_id, login, name, surname, birthDate, regDate, lastSuccessfulLogin, attempts, lastUnsuccessfulLogin, lastActive, email FROM users WHERE user_id = ?');
		$statement->bind_param('i', $idUserToGet);
		if($statement->execute())
		{
			$result = $statement->get_result();
			return $result->fetch_assoc();
		}
    }

	public function isLogged()
	{
		return isset($_SESSION["user_id"]);
	}

	public function signUp($name, $surname, $email, $birth, $username, $password)
	{
		if(empty($name) || empty($surname) || empty($email) || empty($birth) || empty($username) || empty($password))
		{
			$_SESSION['error'] = 'Wypełnij wszystkie pola!<br>';
		}
		else if(!isDate($birth))
		{
			$_SESSION['error'] = 'Podałeś niepoprawną datę. Format: DD/MM/RRRR<br>';
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
			$statement = $this->connect->prepare('SELECT user_id FROM users WHERE login = ?');
			$statement->bind_param('s', $username);
			if($statement->execute())
			{
				$result = $statement->get_result();
				if($result->num_rows)
				{
					$_SESSION['error'] = 'Taki użytkownik istnieje w naszym systemie. Zaloguj się!<br>';
				}
				else
				{
					//INSERT INTO `users` (`user_id`, `login`, `password`, `name`, `surname`, `birthDate`, `regDate`, `lastSuccessfulLogin`, `attempts`, `lastUnsuccessfulLogin`, `lastActive`) VALUES (NULL, 'test', 'test', 'test', 'test', 'test', '', '', '', '', '');
					$statement = $this->connect->prepare("INSERT INTO `users` (`login`, `password`, `name`, `surname`, `birthDate`, `regDate`, `email`) VALUES (?, ?, ?, ?, STR_TO_DATE(?, '%m/%d/%Y'), NOW(), ?)");
					$passhash = password_hash($password, PASSWORD_DEFAULT);
					$statement->bind_param('ssssss', $username, $passhash, $name, $surname, $birth, $email);
					if($statement->execute())
					{
						$_SESSION['error'] = 'Twoje konto zostało utworzone. Zaloguj się!<br>'; //narazie nigdzie się nie wyświetla, bo usuwa się zawartość chwilę przed przekierowaniem (rendering strony signup.php)
						header('Location: http://'.$_SERVER["HTTP_HOST"]);
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
			$statement = $this->connect->prepare('SELECT user_id, password, attempts, lastUnsuccessfulLogin FROM users WHERE login = ?');
			$statement->bind_param('s', $login);
			if($statement->execute())
			{
				$result = $statement->get_result();
				if(!$result->num_rows)
				{
					$_SESSION['error'] = 'Taki użytkownik nie istnieje w naszym systemie. Zarejestruj się!<br>';
				}
				else
				{
					$usernameData = $result->fetch_assoc();
					if($usernameData["attempts"] > 3 && strtotime($usernameData["lastUnsuccessfulLogin"]) + 300>= time()) //300 sekund - czas dodatkowy, aby uniknąć brute force
					{
						$_SESSION['error'] = 'Próbowałeś zalogować się zbyt wiele razy. Spróbuj ponownie za 5 minut.<br>';
					}
					else if(password_verify($passwordword, $usernameData["password"]))
					{
						$_SESSION["user_id"] = $usernameData["user_id"];
						$statement = $this->connect->prepare('UPDATE `users` SET lastSuccessfulLogin = NOW(), attempts = 0 WHERE login = ?');
						$statement->bind_param('s', $login);
						$statement->execute();
					}
					else
					{
						//INSERT INTO `users` (`user_id`, `login`, `password`, `name`, `surname`, `birthDate`, `regDate`, `lastSuccessfulLogin`, `attempts`, `lastUnsuccessfulLogin`, `lastActive`) VALUES (NULL, 'test', 'test', 'test', 'test', 'test', '', '', '', '', '');
						$_SESSION['error'] = 'Błędny login lub hasło!<br>';
						$statement = $this->connect->prepare('UPDATE `users` SET lastUnsuccessfulLogin = NOW(), attempts = attempts + 1 WHERE login = ?');
						$statement->bind_param('s', $login);
						$statement->execute();
					}
				}
			}
		}
	}
}