CREATE TABLE gc_test (
	idx			INT				NOT NULL AUTO_INCREMENT,
	id			VARCHAR(32)	,
	title		VARCHAR(32)	,
	content		text,
	level		INT(2)			default 1,
	primary key (idx)
);