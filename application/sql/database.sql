/* TABLE NAME : gc_user */
CREATE TABLE gc_user (
	idx			INT				NOT NULL AUTO_INCREMENT,
	user_id		VARCHAR(32)		NOT NULL,
	password	VARCHAR(32)		NOT NULL,
	first_name	VARCHAR(32),
	last_name	VARCHAR(32),
	email		varchar(100),
	level		INT(2)			default 1,	
	primary key (idx)
);

/* TABLE NAME : gc_language */
CREATE TABLE gc_language (
	idx			INT				NOT NULL AUTO_INCREMENT,
	default		char(1)			NOT NULL,
	language	varchar(50)		NOT NULL,
	primary key (idx)
);

/* TABLE NAME : gc_page */
CREATE TABLE gc_page (
	idx			INT		NOT NULL AUTO_INCREMENT,	
	parent_idx	INT		NOT NULL,
	od			INT		NOT NULL,
	display		CHAR(1)		NOT NULLL,
	type		VARCHAR(20)	NOT NULL,
	primary key (idx)
);

/* TABLE NAME : gc_page_lang */
CREATE TABLE gc_page_lang (
	page_idx	INT		NOT NULL,
	lang_idx	INT		NOT NULL,
	title		VARHCAR(50)	NOT NULL
);

/* TABLE NAME : gc_content */
CREATE TABLE gc_content (
	idx			INT	NOT NULL AUTO_INCREMENT,
	seo_idx		INT	NOT NULL,
	page_idx	INT	NOT NULL,
	primary key (idx)
);

/* TABLE NAME : gc_content_lang */
CREATE TABLE gc_content_lang (
	content_idx		INT		NOT NULL,
	lang_idx		INT		NOT NULL,
	content			TEXT
);

/* TABLE NAME : gc_gallery */

/* TABLE NAME : gc_gallery_lang */

/* TABLE NAME : images */

/* TABLE NAME : gc_product */

/* TABLE NAME : gc_product_lang */