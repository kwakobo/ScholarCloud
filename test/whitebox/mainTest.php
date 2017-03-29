<?php


use PHPUnit\Framework\TestCase;


function fromString() {
    return (1); // Returns 0 for odd and 1 for even
}

function getAuthor() {
    return (1);
}

function getTitle() {
    return (1);
}

function getLink() {
    return (1);
}

function getFrequency() {
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
        $this->assertEquals("", getAuthor("name"));
    }

    public function checkPaperTitle() {
        $this->assertEquals("", getTitle("title"));
    }

    public function checkLink() {
        $this->assertEquals("", getLink("title"));
    }

    public function checkWordFrequency() {
        $this->assertEquals("", getFrequency(50));
    }

    public function checkWordFrequency() {
        $this->assertEquals("", getFrequency(50));
    }
}