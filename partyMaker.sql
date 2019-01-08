CREATE TABLE users(
	user_id int(20) UNSIGNED NOT NULL AUTO_INCREMENT,
	login varchar(20) NOT NULL UNIQUE,
	password varchar(255) NOT NULL,
	name varchar(20) NOT NULL,
	surname varchar(20) NOT NULL,
	birthDate DATE NOT NULL,
	regDate TIMESTAMP NOT NULL,
	lastSuccessfulLogin TIMESTAMP NOT NULL,
	attempts INT UNSIGNED DEFAULT 0,
	lastUnsuccessfulLogin TIMESTAMP NOT NULL,
    	lastActive TIMESTAMP NOT NULL,
	email varchar(255) NOT NULL,
    	avatar varchar(255) NOT NULL,
    	ip varchar(16) NOT NULL,
	PRIMARY KEY (user_id)
);

CREATE TABLE events(
    event_id int(20) UNSIGNED NOT NULL AUTO_INCREMENT,
    creator_id int(20) UNSIGNED NOT NULL,
    event_name varchar(100) NOT NULL,
    event_description varchar(400) NOT NULL,
    event_date date not null,
    event_location varchar(100) NOT NULL,
    event_logo varchar(255) NOT NULL,
    PRIMARY KEY (event_id),
    FOREIGN KEY (creator_id) REFERENCES users(user_id)
);

CREATE TABLE events_participants (
    info_id int(20) UNSIGNED NOT NULL AUTO_INCREMENT,
    event_id int(20) UNSIGNED NOT NULL,
    participant_id int(20) UNSIGNED NOT NULL,
    status int(3) UNSIGNED NOT NULL,
    PRIMARY KEY (info_id),
    FOREIGN KEY (event_id) REFERENCES events(event_id),
    FOREIGN KEY (participant_id) REFERENCES users(user_id)
);

create table events_posts (
    post_id int(20) UNSIGNED NOT NULL AUTO_INCREMENT,
    event_id int(20) UNSIGNED NOT NULL,
    post_creator int(20) UNSIGNED NOT NULL,
    post_content varchar(500) NOT NULL,
    post_date date NOT NULL,
    PRIMARY KEY (post_id),
    FOREIGN KEY (event_id) REFERENCES events(event_id),
    FOREIGN KEY (post_creator) REFERENCES users(user_id)
);

-- events and its participants
select ev.event_name, us.name, us.surname
	from events_participants p
		join events ev
			on ev.event_id = p.event_id
				join users us
					on p.participant_id = us.user_id;
-- optionally you can add where clause here like: where ev.event_id = 10; to get participants of particular event

-- how many participants per event?
select ev.event_id, count(ev.event_id)
	from events_participants p
		join events ev
			on p.event_id = ev.event_id
				join users us
					on p.participant_id = us.user_id
-- optionally you can add where clause here like: where ev.event_id = 10 to get number of participants of particular event
						group by event_id;

-- event details when particular_participant is given
select ev.event_id, ev.event_name, ev.event_description, ev.event_date, ev.event_location, ev.event_logo 
	from events ev
		join events_participants p 
			on ev.event_id = p.event_id
				where p.participant_id = 10; -- whatever numeric value that corresponds to participant_id
				
INSERT INTO USERS (login,
	password,
	name,
	surname,
	birthDate, 
	regDate, 
	lastSuccessfulLogin, 
	attempts,
	lastUnsuccessfulLogin, 
	lastActive,
	email,
	avatar,
	ip ) VALUES ('maciex',
    'password1',
    'Maciej',
    'Kowalski',
    sysdate(),
    sysdate(),
    sysdate(),
    3,
    sysdate(),
    sysdate(),
    'maciex@gmail.com',
    'wsciekly zolw',
    '127.0.0.1'
    ), ('krzysiex',
    'password2',
    'Krzysztof',
    'Rogalski',
    sysdate(),
    sysdate(),
    sysdate(),
    2,
    sysdate(),
    sysdate(),
    'krzysiex@gmail.com',
    'wsciekly lampart',
    '127.0.0.1'
    ), ('szymix',
    'password3',
    'Szymon',
    'Zimbawe',
    sysdate(),
    sysdate(),
    sysdate(),
    5,
    sysdate(),
    sysdate(),
    'szymix@gmail.com',
    'wsciekly tygrys',
    '127.0.0.1'
    ), ('bartoszex',
    'password4',
    'Bartosz',
    'Rafonix',
    sysdate(),
    sysdate(),
    sysdate(),
    11,
    sysdate(),
    sysdate(),
    'bartoszex@gmail.com',
    'wsciekly gepart',
    '127.0.0.1'
    );
    
insert into events (creator_id,
    event_name,
    event_description,
    event_date,
    event_location,
    event_logo,
    event_category,
    min_age
    ) values (2, 
	'urodziny',
    'super bedzie',
    sysdate(),
    'Pabianice',
    'Miecze',
    'Party',
    8), (3, 
	'wybory prezydenckie',
    'bede glosowal na siebie',
    sysdate(),
    'Warszawa',
    'Kopertka',
    'Culture',
    8);
    
insert into events_participants (event_id,
    participant_id,
    status) values 
    (1, 2, 1), (1,3,1), (1,4,1), (1,5,1), (2, 3,1), (2,4,1);
