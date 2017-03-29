<?php


use PHPUnit\Framework\TestCase;


function fromString() {
    return (1); // Returns 0 for odd and 1 for even
}

function getAuthor() {
    return (1);
}
/**
 * @covers Email
 */
final class EmailTest extends TestCase
{
    //
    public function testCanBeUsedAsString()
    {
        $this->assertEquals(2, fromString("hello")); 
    }

    public function checkAuthor() {
        $this->assertEquals("", getAuthor("name"))
    }
}