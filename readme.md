# Configurations
Configurations read/write using SQLite for PHP

## Features
  - Categorized configurations
  - Name, Value pairs
  - Read, Write configurations
  - Updates configurations

## Auto
  - Create configuration database
  - Create necessary table

# Usage example

    $configurations = new configurations();
    
    $new_value = "777";
    $configurations->write("counter", $new_value);
    
    $value = $configurations->read("counter");
