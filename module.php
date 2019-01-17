<?php
	//if(isset($_POST["info"]) && $_POST["info"] == "mainPageStart" && isset($_SESSION["test"]))
		echo json_encode(
			array(
			'success' =>
				array(
				'clear' => true,
				'forPrinting'  =>
					array(
						array('id' => 0, 'picture' => 'szymon.jpg', 'name' => 'Sylwester u Szymona', 'members' => 0, 'category' => 'Okolicznosciowe', 'date' => '30.02.2019', 'location' => 'KNZ' ),
						array('id' => 1, 'picture' => 'melo.png', 'name' => 'Koncert Szymon x Szymon w Łodzi!', 'members' => 1, 'category' => 'Koncerty', 'date' => '31.02.2019', 'location' => 'Łódź'),
						array('id' => 2, 'picture' => 'stol.png', 'name' => 'Wigilia u Szymona vol. 2', 'members' => 222, 'category' => 'Okolicznosciowe', 'date' => '24.12.2018', 'location' => 'Warszawa'),
						array('id' => 3, 'picture' => 'panoramaLodzi.xd', 'name' => 'Imprezuję z Mikołajem w Łodzi', 'members' => 321, 'category' => 'Okolicznosciowe', 'date' => '06.12.2018', 'location' => 'Łódź'),
						array('id' => 4, 'picture' => 'szampan.exe', 'name' => '18stka Szymona', 'members' => 2, 'category' => 'Urodziny', 'date' => '29.02.2018', 'location' => 'KNZ')))));
?>
