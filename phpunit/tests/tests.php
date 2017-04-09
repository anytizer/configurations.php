<?php
require_once("../../src/class.configurations.inc.php");

//$configurations = new configurations("DATABASE");
//$value = $configurations->read("HOSTNAME");
//if(!$value)
//{
//	throw new Exception("Value not found for: HOSTNAME.");
//}

#$configurations = new configurations("DATABASE");

$configurations = new configurations("DATABASE");
$configurations->cleanup();

$configurations->write("HOSTNAME", "localhost");
$configurations->write("USERNAME", "username");
$configurations->write("PASSWORD", "password");
$configurations->write("DATABASE", "database");

echo "Reading value: ", $configurations->read("hostname");
