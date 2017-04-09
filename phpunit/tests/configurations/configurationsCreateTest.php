<?php
namespace tests\configurations;
use PHPUnit\Framework\TestCase;
use common\configurations;

/**
 * SQLite based tests
 */
class configurationsCreateTest extends TestCase
{
	private $configurations;
	
	public function setup()
	{
		$category = "Group One";
		$this->configurations = new configurations($category);
	}

	/**
	 * Read Test
	 */
	public function testReadInvalidName()
	{
		$value = $this->configurations->read("non-existing");
		
		$this->assertEquals("", $value);
	}
	
	/**
	 * Create new group
	 */
	public function testNewGroup()
	{
		$new_value = "99";
		$this->configurations = new configurations("Group Two");
		$this->configurations->write("counter", $new_value);
		$value = $this->configurations->read("counter");
		
		$this->assertEquals($new_value, $value);
	}
}