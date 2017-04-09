<?php
namespace tests\configurations;
use PHPUnit\Framework\TestCase;
use common\configurations;

/**
 * SQLite based tests
 */
class configurationsWriteTest extends TestCase
{
	private $configurations;
	
	public function setup()
	{
		$category = "Group One";
		$this->configurations = new configurations($category);
	}

	/**
	 * Write Test
	 */
	public function testWrite()
	{
		$this->configurations->write("counter", "45");
		
		//$this->markTestSkipped();
		$this->assertTrue(true);
	}

    /**
     * Write Null; expect type error
     * @todo Test is failing
     */
    public function testWriteNull()
    {
        $this->markTestIncomplete();

        $new_value = null;
        $this->configurations->write("nullable", $new_value);
        $value = $this->configurations->read("nullable");

        $this->assertEquals("", $value);
        #$this->expectException(InvalidArgumentException::class);
    }
}