CREATE TABLE gc_user (
	idx		INT			NOT NULL AUTO_INCREMENT,
	user_id		VARCHAR(32)		NOT NULL,
	password	VARCHAR(32)		NOT NULL,
	first_name	VARCHAR(32),
	last_name	VARCHAR(32),
	email		varchar(100),
	level		INT(2)			default 1,	
	primary key (idx)
);