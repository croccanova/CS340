
DROP TABLE IF EXISTS enrollment;
DROP TABLE IF EXISTS characters;
DROP TABLE IF EXISTS class;
DROP TABLE IF EXISTS house;
DROP TABLE IF EXISTS patronus;
DROP TABLE IF EXISTS wand;


CREATE TABLE class
(
	id INT(11) AUTO_INCREMENT NOT NULL,
	name VARCHAR(100) NOT NULL,
	instructor VARCHAR(100),
	PRIMARY KEY (id),
	UNIQUE (name)	
)ENGINE = InnoDB;



CREATE TABLE house
(
	id INT(11) AUTO_INCREMENT NOT NULL,
	name VARCHAR(100) NOT NULL,
	symbol VARCHAR(100),
	PRIMARY KEY (id),
	UNIQUE (name)	
)ENGINE = InnoDB;

CREATE TABLE patronus
(
	id INT(11) AUTO_INCREMENT NOT NULL,	
	form VARCHAR(100),	
	PRIMARY KEY (id),
	UNIQUE (form)
)ENGINE = InnoDB;

CREATE TABLE wand
(
	id INT(11) AUTO_INCREMENT NOT NULL,
	wood VARCHAR(100) NOT NULL,	
	core VARCHAR(100) NOT NULL,
	length DECIMAL(4,2) NOT NULL,
	PRIMARY KEY (id)	
)ENGINE = InnoDB;

CREATE TABLE characters
(
	id INT(11) AUTO_INCREMENT NOT NULL,
	name VARCHAR(100) NOT NULL,
	house_id INT(11) DEFAULT NULL,
	wand_id INT(11) DEFAULT NULL,
	patronus_id INT(11) DEFAULT NULL,
	PRIMARY KEY (id),
	UNIQUE (name),
	FOREIGN KEY(wand_id) references wand(id),
	FOREIGN KEY(house_id) references house(id),
	FOREIGN KEY(patronus_id) references patronus(id)
);

CREATE TABLE enrollment
(	
	student_id INT(11),
	class_id INT(11),
	PRIMARY KEY (student_id, class_id),
	FOREIGN KEY(student_id) references characters(id),
	FOREIGN KEY(class_id) references class(id)	
)ENGINE = InnoDB;



INSERT INTO class (name, instructor) 
VALUES	('Potions', 'Severus Snape'),
		('Charms', 'Filius Flitwick'),
		('Divination', 'Sybill Trelawney'),
		('Transfiguration', 'Minerva McGonagall');



INSERT INTO house (name, symbol) 
VALUES	('Gryffindor', 'Lion'),
		('Ravenclaw', 'Raven'),
		('Hufflepuff', 'Badger'),
		('Slytherin', 'Snake');

INSERT INTO patronus (form) 
VALUES	('Stag'),
		('Jack Russell Terrier'),
		('Otter'),
		(NULL),
		('Hare');

INSERT INTO wand (wood, core, length) 
VALUES	('Holly', 'Phoenix Feather', 11),
		('Willow', 'Inicorn Hair', 14),
		('Vine', 'Dragon Heartstring', 10.75),
		('Hawthorn', 'Unicorn Hair', 10),
		('Ash', 'Unicorn Hair', 12.25),
		('Yew', 'Thestral Hair', 13);

INSERT INTO characters (name, house_id, wand_id, patronus_id) 
VALUES	('Harry Potter', 1, 1, 1),
		('Ronald Weasley', 1, 2, 2),
		('Hermione Granger', 1, 3, 3),
		('Draco Malfoy', 4, 4, 4),
		('Cedric Diggory', 3, 5, 4),
		('Luna Lovegood', 2, 6, 5);

INSERT INTO enrollment (class_id, student_id) 
VALUES	(1, 1),
		(1, 2),
		(1, 3),
		(1, 4),
		(1, 5),
		(2, 3),
		(2, 6),
		(3, 1),
		(3, 2),
		(3, 3),
		(3, 4),
		(4, 3),
		(4, 5);