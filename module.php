<?php
require "includes/config.php";

//echo var_dump($_POST);
	
if(isset($_POST["username"]))
{
	$login = $_POST["username"];
	$password = $_POST["password"];
	$user->logIn($login, $password);
	$_POST = array();
}

if(isset($_POST["username2"]))
{
    $name = $_POST["firstName"];
    $surname = $_POST["lastName"];
    $email = $_POST["email"];
    $birth = $_POST["date"];
    $username = $_POST["username2"];
    $password = $_POST["password2"];
    $user->signUp($name, $surname, $email, $birth, $username, $password);
    $_POST = array();
}

if(isset($_POST["info"]))
	$event->getEvents();

if(isset($_POST["category"])) // && $_POST["formName"] == "filter"
	$event->getEvents($_POST);

if(isset($_POST["search"])) // && $_POST["formName"] == "searching" 
	$event->searchEvent($_POST["search"]);

if(isset($_POST["sort"])) // && $_POST["formName"] == "sorting"
	$event->sortEvents($_POST["sort"]);
	
if(isset($_POST["profile"]))
{
	$profile = $user->data();
	echo json_encode(array('success' => array('fields' => array(
		array('name' => 'login', 'value' => $profile["login"]),
		array('name' => 'name', 'value' => $profile["name"]),
		array('name' => 'surname', 'value' => $profile["surname"]),
		array('name' => 'birthDate', 'value' => $profile["birthDate"]),
		array('name' => 'regDate', 'value' => $profile["regDate"]),
		array('name' => 'lastSuccessfulLogin', 'value' => $profile["lastSuccessfulLogin"]),
		array('name' => 'lastUnsuccessfulLogin', 'value' => $profile["lastUnsuccessfulLogin"]),
		array('name' => 'lastActive', 'value' => $profile["lastActive"]),
		array('name' => 'email', 'value' => $profile["email"]),
		array('name' => 'Adress IP', 'value' => $profile["ip"])
		), 'events' => $event->getEventByCreator())));
}

if(isset($_POST["userEvents"]))
	echo json_encode(array('success' => array('clear' => false, 'forPrinting'  => $event->getEventByCreator())));

if(isset($_POST["eventInfo"]))
	$event->getEventInfo($_POST["eventInfo"]);

if(isset($_POST["eventsParticipate"])) //nieużywana? W KTÓRYCH EVENTACH BIORĘ UDZIAŁ
	$event->eventsParticipate($_POST["eventsParticipate"]);

if(isset($_POST["eventParticipates"])) //nieużywana? KTO BIERZE UDZIAŁ W WYDARZENIU
	$event->getEventParticipants($_POST["eventParticipates"]);

/*$category = array("Sport", "Music", "Party", "Culture");
$name = array("Sylwester", "Choinka", "Urodziny", "Widzew vs ŁKS", "LECH vs LEGIA", "Koncert Metalica", "Koncert ACDC", "Koncert AlterBridge");
$loc = array("Łódz", "Poznań", "Wrocław", "Warszawa");

for($i = 0; $i < 1000; $i++)
{
	echo "INSERT INTO `events` (`event_id`, `creator_id`, `event_name`, `event_description`, `event_date`, `event_location`, `event_logo`, `event_category`, `min_age`) VALUES (NULL, '".rand(1, 9)."', '".$name[array_rand($name)]."', '', 'NOW() - INTERVAL FLOOR(RAND() * 14) DAY', '".$loc[array_rand($loc)]."', 'text.exe', '".$category[array_rand($category)]."', '".rand(1, 99)."');<br>";
}*/
?>