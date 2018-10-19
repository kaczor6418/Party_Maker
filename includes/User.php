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

	public function logIn($login, $password)
	{
		if(empty($login) || empty($password))
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
					$userData = $result->fetch_assoc();

					if(password_verify($password, $userData["password"]))
					{
						$_SESSION["user_id"] = $userData["id"];
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