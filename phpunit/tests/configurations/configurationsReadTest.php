<?php
namespace tests\configurations;
use PHPUnit\Framework\TestCase;
use common\configurations;

/**
 * SQLite based tests
 */
class configurationsReadTest extends TestCase
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
    public function testRead()
    {
        $new_value = "777";
        $this->configurations->write("counter", $new_value);
        $value = $this->configurations->read("counter");

        $this->assertEquals($new_value, $value);
    }
}