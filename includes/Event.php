<?php
function resultToArray($result) 
{
    $rows = array();
    while($row = $result->fetch_assoc()) 
	{
        $rows[] = $row;
    }
    return $rows;
}
	
class Event
{
	private $connect;

	public function __construct($connect)
	{
		$this->connect = $connect;
	}

	public function getEventByCreator($idEventCreator = null)
	{
		$return_arr = array();
		
		if($idEventCreator == null)
        {
        	if(isset($_SESSION['user_id']))
        	{
        		$idEventCreator = $_SESSION['user_id'];
        	}
        	else
        	{
        		die("Użytkownik nie jest zalogowany!");
        	}
        }
		
    	$statement = $this->connect->prepare('SELECT event_id, event_name, event_description, event_date, event_category, event_location, event_logo FROM events WHERE creator_id = ?');
		$statement->bind_param('i', $idEventCreator);
		$statement->execute();
		$result = $statement->get_result();
		
		while ($row = $result->fetch_assoc()) 
		{
			$row_array['id'] = $row['event_id'];
			$row_array['picture'] = $row['event_logo'];
			$row_array['name'] = $row['event_name'];
			$row_array['members'] = $this->getNumberOfParticipants($row['event_id'])["value"];
			$row_array['category'] = $row['event_category'];
			$row_array['date'] = $row['event_date'];
			$row_array['location'] = $row['event_location'];
			array_push($return_arr, $row_array);
		}
		return $return_arr;
	}

	public function eventsParticipate($idParticipate = null)
	{
		$return_arr = array();

		if($idParticipate == null)
		{
			if(isset($_SESSION['user_id']))
			{
				$idParticipate = $_SESSION['user_id'];
			}
			else
			{
				die("Użytkownik nie jest zalogowany!");
			}
		}
		$statement = $this->connect->prepare('select ev.event_id, ev.event_name, ev.event_category, ev.event_description, ev.event_date, ev.event_location, ev.event_logo from events ev join events_participants p on ev.event_id = p.event_id where p.participant_id = ?');
		$statement->bind_param('i', $idParticipate);
		$statement->execute();
		$result = $statement->get_result();
		while ($row = $result->fetch_assoc()) 
		{
			$row_array['id'] = $row['event_id'];
			$row_array['picture'] = $row['event_logo'];
			$row_array['name'] = $row['event_name'];
			$row_array['members'] = $this->getNumberOfParticipants($row['event_id'])["value"];
			$row_array['category'] = $row['event_category'];
			$row_array['date'] = $row['event_date'];
			$row_array['location'] = $row['event_location'];
			array_push($return_arr, $row_array);
		}

		echo json_encode(array('success' => array('clear' => false, 'forPrinting'  => $return_arr)));
	}

	/*public function getUpcomingEvents()
	{
		$statement = $this->connect->prepare('SELECT event_id, event_name, event_description, event_date, event_location, event_logo FROM events WHERE dateEvent >= NOW() AND dateEvent <= DATE_ADD(NOW(), INTERVAL 7 DAY)');
		//SELECT * FROM `users` WHERE birthDate >= NOW() AND birthDate <= DATE_ADD(NOW(), INTERVAL 10 DAY);
		if($statement->execute())
		{
			$result = $statement->get_result();
			return $result->fetch_assoc();
		}
	}*/
	
	public function searchEvent($name)
	{
		$return_arr = array();
		$statement = $this->connect->prepare("SELECT * FROM events WHERE event_name LIKE '%".$name."%'");
		$statement->execute();
		$result = $statement->get_result();

		while ($row = $result->fetch_assoc()) 
		{
			$row_array['id'] = $row['event_id'];
			$row_array['picture'] = $row['event_logo'];
			$row_array['name'] = $row['event_name'];
			$row_array['members'] = $this->getNumberOfParticipants($row['event_id'])["value"];
			$row_array['category'] = $row['event_category'];
			$row_array['date'] = $row['event_date'];
			$row_array['location'] = $row['event_location'];
			array_push($return_arr, $row_array);
		}
		echo json_encode(array('success' => array('clear' => true, 'forPrinting'  => $return_arr)));
	}
	
	/*
	Least popular, Most Popular, Latest coming events, Of latest coming events
	*/
	
	public function sortEvents($data)
	{
		$return_arr = array();
		
		switch($data)
		{
			case "Least popular": $statement = $this->connect->prepare('select event_id, creator_id, event_name, event_description, event_date, event_location, event_logo, event_category, min_age from ( select e.event_id id, count(info_id) cnt from events e left join events_participants ep on e.event_id = ep.event_id group by e.event_id) t1 join (select * from events) t2 where t1.id = t2.event_id order by cnt'); break;
			case "Most Popular": $statement = $this->connect->prepare('select event_id, creator_id, event_name, event_description, event_date, event_location, event_logo, event_category, min_age from (select e.event_id as id, count(info_id) cnt from events e left join events_participants ep on e.event_id = ep.event_id group by e.event_id) t1, (select * from events) t2 where t1.id = t2.event_id order by cnt desc'); break;
			case "Latest coming events": $statement = $this->connect->prepare('select * from events WHERE event_date >= NOW() order by event_date asc'); break; //TODO: add column event_category, min_age
		}
		
		$statement->execute();
		$result = $statement->get_result();

		while ($row = $result->fetch_assoc()) 
		{
			$row_array['id'] = $row['event_id'];
			$row_array['picture'] = $row['event_logo'];
			$row_array['name'] = $row['event_name'];
			$row_array['members'] = $this->getNumberOfParticipants($row['event_id'])["value"];
			$row_array['category'] = $row['event_category'];
			$row_array['date'] = $row['event_date'];
			$row_array['location'] = $row['event_location'];
			array_push($return_arr, $row_array);
		}

		echo json_encode(array('success' => array('clear' => true, 'forPrinting'  => $return_arr)));
	}	
	
	public function getEventInfo($idEvent)
	{		
		$statement = $this->connect->prepare("SELECT * FROM events WHERE event_id = ?");
		$statement->bind_param('i', $idEvent);
		$statement->execute();
		$result = $statement->get_result();
		$row = $result->fetch_assoc();
		$row_array['location'] = $row['event_location'];
		echo json_encode(array('success' => array('fields' => array(
		array('name' => 'name', 'value' => $row['event_name']),
		array('name' => 'members', 'value' => $this->getNumberOfParticipants($row['event_id'])["value"]),
		array('name' => 'event_category', 'value' => $row['event_category']),
		array('name' => 'event_date', 'value' => $row['event_date']),
		array('name' => 'event_location', 'value' => $row['event_location'])
		), 'eventDescription' => $row['event_description'])));
	}
	
	public function getEvents($data)
	{
		$whereClause = array();
		$return_arr = array();
		
		if(!empty($data["localization"]))
			$whereClause[] = "event_location LIKE '%".$data["localization"]."%'";
		
		if(!empty($data["category"]))
			$whereClause[] = "event_category = '".$data["category"]."'";
		
		if(!empty($data["age"]))
			$whereClause[] = "min_age <= ".$data["age"];
		
		if(!empty($data["date"]))
			$whereClause[] = "event_date = STR_TO_DATE('".$data["date"]."', '%d/%m/%Y')";
		
		$finalClause = implode(" AND ", $whereClause);
		
		if(!empty($finalClause))
			$statement = $this->connect->prepare('SELECT * FROM events WHERE '.$finalClause);
		else
			$statement = $this->connect->prepare('SELECT * FROM events');
		
		$statement->execute();
		$result = $statement->get_result();
		
		while ($row = $result->fetch_assoc()) 
		{
			$row_array['id'] = $row['event_id'];
			$row_array['picture'] = $row['event_logo'];
			$row_array['name'] = $row['event_name'];
			$row_array['members'] = $this->getNumberOfParticipants($row['event_id'])["value"];
			$row_array['category'] = $row['event_category'];
			$row_array['date'] = $row['event_date'];
			$row_array['location'] = $row['event_location'];
			array_push($return_arr, $row_array);
		}
		echo json_encode(array('success' => array('clear' => true, 'forPrinting'  => $return_arr)));
	}
	
	public function getNumberOfParticipants($event_id)
	{
		$statement = $this->connect->prepare('select count(*) value from events e join events_participants ep on ep.event_id = e.event_id WHERE e.event_id = ?');
		$statement->bind_param('i', $event_id);
		if($statement->execute())
		{
			$result = $statement->get_result();
			return $result->fetch_assoc();
		}
	}

	/*public function getPostsByCreator($idCreator = null)
	{
		if($idCreator == null)
		{
			if(isset($_SESSION['user_id']))
			{
				$idCreator = $_SESSION['user_id'];
			}
			else
			{
				die("Użytkownik nie jest zalogowany!");
			}
		}
		
		$statement = $this->connect->prepare('SELECT post_id, event_id, post_creator, post_content, post_date FROM events_posts WHERE creator_id = ?');
		$statement->bind_param('i', $idCreator);
		if($statement->execute())
		{
			$result = $statement->get_result();
			return $result->fetch_assoc();
		}
	}
	
	public function getCommentsByCreator($idCreator = null)
	{
		if($idCreator == null)
		{
			if(isset($_SESSION['user_id']))
			{
				$idCreator = $_SESSION['user_id'];
			}
			else
			{
				die("Użytkownik nie jest zalogowany!");
			}
		}
		
		$statement = $this->connect->prepare('SELECT comment_id, post_id, comment_creator, comment_content, comment_date FROM post_comments WHERE creator_id = ?');
		$statement->bind_param('i', $idCreator);
		if($statement->execute())
		{
			$result = $statement->get_result();
			return $result->fetch_assoc();
		}
	}
	*/
	public function getEventParticipants($event_id)
	{
		$return_arr = array();
		$statement = $this->connect->prepare('select ev.event_name, us.name, us.surname from events_participants p join events ev on ev.event_id = p.event_id join users us on p.participant_id = us.user_id where ev.event_id = ?');
		$statement->bind_param('i', $event_id);
		$statement->execute();
		$result = $statement->get_result();
		while ($row = $result->fetch_assoc()) 
		{
			$row_array['name'] = $row['name'];
			$row_array['usurname'] = $row['surname'];
			array_push($return_arr, $row_array);
		}

		echo json_encode(array('success' => array('forPrinting'  => $return_arr)));
	}
	//getNeighbourhoodEvent, createEvent, createPost, createComment
}
/*	events:
		event_id
		creator_id
		nameEvent
		descEvent
		dateEvent
		locEvent (location, pewnie string(?))
		logoEvent (pewnie jakiś hash, więc VARCHAR(255))

	participantsEvent:
		info_id (mało potrzebne, ale musi być)
		event_id
		participant_id
		status (w sumie nie wiem czy będą jakieś statusy, ale dodaj; zapewne jakiś mały int)

	postsInEvent:
		post_id
		event_id
		postCreatorId
		postText (jakiś duży VARCHAR)
		postDate
	
	commentsInEvent:
		comment_id
		event_id
		commentCreatorId
		commentText (jakiś duży VARCHAR)
		commentDate
*/
?>