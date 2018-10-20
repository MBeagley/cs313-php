CREATE TABLE players (
  id SERIAL,
  username VARCHAR(255) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  PRIMARY KEY (id)
);

CREATE TABLE characters (
	id SERIAL,
	name VARCHAR(100) NOT NULL,
	strong_against INTEGER,
	weak_against INTEGER,
	PRIMARY KEY (id),
	FOREIGN KEY (strong_against) REFERENCES characters(id),
	FOREIGN KEY (weak_against) REFERENCES characters(id)
);

CREATE TABLE statistics (
	id SERIAL,
	player INTEGER NOT NULL,
	character INTEGER NOT NULL,
	wins INTEGER,
	loses INTEGER,
	PRIMARY KEY (id),
	FOREIGN KEY (player) REFERENCES players(id),
	FOREIGN KEY (character) REFERENCES characters(id)
);