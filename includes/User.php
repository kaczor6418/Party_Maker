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
        		die("Użytkownik nie jest zalogowany!");
        	}
        }
    	$statement = $this->connect->prepare('SELECT user_id, login, name, surname, birthDate, regDate, lastSuccessfulLogin, attempts, lastUnsuccessfulLogin, lastActive, email, ip FROM users WHERE user_id = ?');
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
		$errorObjString = array();
		
		if(empty($name) || empty($surname) || empty($email) || empty($birth) || empty($username) || empty($password))
		{
			echo json_encode(array('error' => array('info' => 'Wypełnij wszystkie pola!')));
			//echo "<br>".$name.", ".$username.", ".$email.", ".$birth.", ".$username.", ".$password;
			die();
		}
		
		if(!isDate($birth))
		{
			//echo json_encode(array('error' => array('info' => 'odałeś niepoprawną datę. Format: DD/MM/RRRR', 'errorObj' => 'birdt')));
			$errorObjString[] = 'birdt';
		}
		
		if(strlen($name) < 3)
		{
			//echo json_encode(array('error' => array('info' => 'Twoje imię nie może mieć mniej niż 3 znaki', 'errorObj' => 'name')));
			$errorObjString[] = 'firstName';
		}
		
		if(strlen($surname) < 3)
		{
			//echo json_encode(array('error' => array('info' => 'Twoje nazwisko nie może mieć mniej niż 3 znaki', 'errorObj' => 'surname')));
			$errorObjString[] = 'lastName';
		}
		
		if(!filter_var($email, FILTER_VALIDATE_EMAIL))
		{
			//echo json_encode(array('error' => array('info' => 'Podane adres email jest niepoprawny!', 'errorObj' => 'email')));
			$errorObjString[] = 'email';
		}
		
		if(strlen($username) < 3)
		{
			//echo json_encode(array('error' => array('info' => 'Nazwa użytkownika nie może być krótsza niż 3 znaki', 'errorObj' => 'user')));
			$errorObjString[] = 'user';
		}
		
		if(strlen($password) < 8)
		{
			//echo json_encode(array('error' => array('info' => 'Twoje hasło musi mieć minimum 8 znaków', 'errorObj' => 'pass')));
			$errorObjString[] = 'pass';
		}
		if(!empty($errorObjString))
		{	
			echo json_encode(array('error' => array('info' => 'Znaleziono bledy!', 'errorFileds' => $errorObjString)));
			//implode(",", $errorObjString)
			die();
		}
		
		
		$statement = $this->connect->prepare('SELECT user_id FROM users WHERE login = ?');
		$statement->bind_param('s', $username);
		if($statement->execute())
		{
			$result = $statement->get_result();
			if($result->num_rows)
			{
				echo json_encode(array('error' => array('info' => 'Taki użytkownik już istnieje w naszym systemie. Wprowadź inną nazwę.', 'errorObj' => 'user')));
			}
			else
			{
				$statement = $this->connect->prepare('SELECT user_id FROM users WHERE email = ?');
				$statement->bind_param('s', $email);
				if($statement->execute())
				{
					$result = $statement->get_result();
					if($result->num_rows)
					{
						echo json_encode(array('error' => array('info' => 'Taki email jest już zarejestrowany. Zaloguj się!', 'errorObj' => 'email')));
					}
					else
					{
						//INSERT INTO `users` (`user_id`, `login`, `password`, `name`, `surname`, `birthDate`, `regDate`, `lastSuccessfulLogin`, `attempts`, `lastUnsuccessfulLogin`, `lastActive`) VALUES (NULL, 'test', 'test', 'test', 'test', 'test', '', '', '', '', '');
						$statement = $this->connect->prepare("INSERT INTO `users` (`login`, `password`, `name`, `surname`, `birthDate`, `regDate`, `email`, `ip`) VALUES (?, ?, ?, ?, STR_TO_DATE(?, '%d/%m/%Y'), NOW(), ?, ?)");
						$passhash = password_hash($password, PASSWORD_DEFAULT);
						$ip_address = $_SERVER['REMOTE_ADDR'];
						$statement->bind_param('sssssss', $username, $passhash, $name, $surname, $birth, $email, $ip_address);
						if($statement->execute())
						{
							echo json_encode(array('success' => array('info' => 'Twoje konto zostało utworzone. Zaloguj się!')));
						}
						else
						{
							echo json_encode(array('error' => array('info' => 'Coś poszło nie tak :c Spróbuj ponownie!')));
						}
					}
				}
			}
		}
	}

	public function logIn($login, $passwordword)
	{
		if(empty($login) || empty($passwordword))
		{
			echo json_encode(array('error' => 'Wypełnij wszystkie pola!'));
		}
		else
		{
			$statement = $this->connect->prepare('SELECT login, user_id, password, attempts, lastUnsuccessfulLogin FROM users WHERE login = ? OR email = ?');
			$statement->bind_param('ss', $login, $login);
			if($statement->execute())
			{
				$result = $statement->get_result();
				if(!$result->num_rows)
				{
					
				/*'{"error": {
                "info": "error/success info",
                "errorObj": "firstNanem, lastName"
                }}'*/
					echo json_encode(array('error' => array('info' => 'Takie konto nie istnieje!')));
				}
				else
				{
					$usernameData = $result->fetch_assoc();
					if($usernameData["attempts"] > 3 && strtotime($usernameData["lastUnsuccessfulLogin"]) + 300>= time()) //300 sekund - czas dodatkowy, aby uniknąć brute force
					{
						echo json_encode(array('error' => array('info' => 'Próbowałeś zalogować się zbyt wiele razy. Spróbuj ponownie za 5 minut.')));
					}
					else if(password_verify($passwordword, $usernameData["password"]))
					{
						$_SESSION["user_id"] = $usernameData["user_id"];
						$ip_address = $_SERVER['REMOTE_ADDR'];
						$statement = $this->connect->prepare('UPDATE `users` SET lastSuccessfulLogin = NOW(), attempts = 0, ip = ? WHERE login = ?');
						$statement->bind_param('ss', $ip_address, $usernameData["login"]);
						$statement->execute();
						echo json_encode(array('success' => array('info' => 'Zalogowałeś się!')));
					}
					else
					{
						//INSERT INTO `users` (`user_id`, `login`, `password`, `name`, `surname`, `birthDate`, `regDate`, `lastSuccessfulLogin`, `attempts`, `lastUnsuccessfulLogin`, `lastActive`) VALUES (NULL, 'test', 'test', 'test', 'test', 'test', '', '', '', '', '');
						echo json_encode(array('error' => array('info' => 'Błędny login lub hasło!')));
						$statement = $this->connect->prepare('UPDATE `users` SET lastUnsuccessfulLogin = NOW(), attempts = attempts + 1 WHERE login = ?');
						$statement->bind_param('s', $usernameData["login"]);
						$statement->execute();
					}
				}
			}
		}
	}
}