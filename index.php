<?php
namespace tests;

require_once("src/libraries/common/class.configurations.inc.php");

use common\configurations;

$group_name = "Group Name1";
$variable_name = "Variable Name1";
$configurations = new configurations($group_name);

$old_value = "101";
$configurations->write($variable_name, $old_value);

$read = $configurations->read($variable_name);
echo sprintf("Group: %s, Variable: %s, Written value: %s, Read value: %s", $group_name, $variable_name, $old_value, $read);

#print_r($configurations);
