<?php
namespace tests;

require_once("src/libraries/common/class.configurations.inc.php");

use common\configurations;

$group_name = "Group Name1";
$variable_name = "Variable Name2";
$configurations = new configurations($group_name);

# First time
#$old_value = "101";
#$configurations->write($variable_name, $old_value);

# Then onwards
$old_value = $configurations->read($variable_name);
$old_value = "".(int)$old_value+1;
$configurations->write($variable_name, $old_value);
$old_value = $configurations->read($variable_name);

$read = $configurations->read($variable_name);
echo sprintf("Group: %s, Variable: %s, Written value: %s, Read value: %s", $group_name, $variable_name, $old_value, $read);

#print_r($configurations);
