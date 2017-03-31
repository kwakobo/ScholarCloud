<?php


use PHPUnit\Framework\TestCase;

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
 * 
 */
final class FrequencyTest extends TestCase
{
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
}