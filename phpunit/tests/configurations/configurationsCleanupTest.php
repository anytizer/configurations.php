<?php
namespace tests\configurations;
use PHPUnit\Framework\TestCase;
use common\configurations;

/**
 * SQLite based tests
 */
class configurationsCleanupTest extends TestCase
{
	private $configurations;
	
	public function setup()
	{
		$category = "Group One";
		$this->configurations = new configurations($category);
	}

	/**
	 * Cleanup test
	 * Run at the last and leave the configuration database as empty.
	 */
	public function testCleanup()
	{
		$new_value = "67";
		$this->configurations->write("counter", $new_value);
		
		$this->configurations->cleanup();
		$value = $this->configurations->read("counter");
		
		$this->assertEquals("", $value);
	}
}