INSERT INTO configurations VALUES ("DATABASE", "HOSTNAME", "%hostname%");
INSERT INTO configurations VALUES ("DATABASE", "USERNAME", "%username%");
INSERT INTO configurations VALUES ("DATABASE", "PASSWORD", "%password%");
INSERT INTO configurations VALUES ("DATABASE", "DATABASE", "%database%");

SELECT * FROM configurations WHERE category='DATABASE';
vacuum;
