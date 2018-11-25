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
		
    	$statement = $this->connect->prepare('SELECT event_id, event_name, event_description, event_date, event_location, event_logo FROM events WHERE creator_id = ?');
		$statement->bind_param('i', $idEventCreator);
		if($statement->execute())
		{
			$result = $statement->get_result();
			return $result->fetch_assoc();
		}
	}

	public function eventsParticipate($idParticipate = null)
	{
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
		$statement = $this->connect->prepare('select ev.event_id, ev.event_name, ev.event_description, ev.event_date, ev.event_location, ev.event_logo from events ev join events_participants p on ev.event_id = p.event_id where p.participant_id = ?');
		$statement->bind_param('i', $idParticipate);
		if($statement->execute())
		{
			$result = $statement->get_result();
			return $result->fetch_assoc();
		}
	}

	public function getUpcomingEvents()
	{
		$statement = $this->connect->prepare('SELECT event_id, event_name, event_description, event_date, event_location, event_logo FROM events WHERE dateEvent >= NOW() AND dateEvent <= DATE_ADD(NOW(), INTERVAL 7 DAY)');
		//SELECT * FROM `users` WHERE birthDate >= NOW() AND birthDate <= DATE_ADD(NOW(), INTERVAL 10 DAY);
		if($statement->execute())
		{
			$result = $statement->get_result();
			return $result->fetch_assoc();
		}
	}

	public function getPostsByCreator($idCreator = null)
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
	
	public function getEventParticipants($event_id)
	{
		$statement = $this->connect->prepare('SELECT event_name, event_date, event_description FROM events WHERE event_id = ?');
		$statement->bind_param('i', $event_id);
		if($statement->execute())
		{
			$result = $statement->get_result();
			if(!$result->num_rows)
			{
				return 'bad event_id';
			}
			else
			{
				$statement = $this->connect->prepare('select ev.event_name, us.name, us.surname from events_participants p join events ev on ev.event_id = p.event_id join users us on p.participant_id = us.user_id where ev.event_id = ?');
				if($statement->execute())
				{
					$result = $statement->get_result();
					$rows = resultToArray($result);
					return $rows;
				}
			}
		}
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