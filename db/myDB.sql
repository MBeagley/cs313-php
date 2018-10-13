CREATE TABLE players (
	id INTEGER PRIMARY KEY,
	name VARCHAR(100) NOT NULL,
	password VARCHAR(100) NOT NULL
);

CREATE TABLE characters (
	id INTEGER PRIMARY KEY,
	name VARCHAR(100) NOT NULL,
	strong_against INTEGER REFERENCES characters(id),
	weak_against INTEGER REFERENCES characters(id)
);

CREATE TABLE statistics (
	id INTEGER PRIMARY KEY,
	player INTEGER REFERENCES players(id),
	character INTEGER REFERENCES characters(id),
	wins INTEGER,
	loses INTEGER
);