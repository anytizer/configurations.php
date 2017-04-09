<?php
namespace tests\configurations;
use PHPUnit\Framework\TestCase;
use common\configurations;

/**
 * SQLite based tests
 */
class configurationsUpdateTest extends TestCase
{
	private $configurations;
	
	public function setup()
	{
		$category = "Group One";
		$this->configurations = new configurations($category);
	}

    /**
	 * Update test
	 */
	public function testUpdate()
	{
		$new_value = "67";
		$this->configurations->write("counter", $new_value);
		$value = $this->configurations->read("counter");
		
		$this->assertEquals($new_value, $value);		
	}
}