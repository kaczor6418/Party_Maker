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
