-- > sqlite3 settings.db

DROP TABLE IF EXISTS configurations;
CREATE TABLE configurations (
	category VARCHAR(255) NOT NULL DEFAULT '',
	name VARCHAR(255) NOT NULL DEFAULT '',
	value VARCHAR(255) NOT NULL DEFAULT '',
	
	PRIMARY KEY(category, name)
);