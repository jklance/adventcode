<?php
require_once dirname(__FILE__) . '/../Day08.php';

class Day08Tests extends PHPUnit_Framework_TestCase {

    private $_day08;

    function setUp() {
        $this->_day08 = new Day08();
    }

    function testEmptyStringLength() {
        $this->assertEquals(2, $this->_day08->getTotalCharacters('""'));
    }

    function testNormalStringLength() {
        $this->assertEquals(2, $this->_day08->getTotalCharacters('"abc"'));
    }

    function testEscapedStringLength() {
        $this->assertEquals(3, $this->_day08->getTotalCharacters('"aaa\"aaa"'));
    }

    function testEscapedHexStringLength() {
        $this->assertEquals(5, $this->_day08->getTotalCharacters('"\x27"'));
    }

    function testMultiEscapesStringLength() {
        $this->assertEquals(6, $this->_day08->getTotalCharacters('"\x27aaa\"aaa"'));
    }

}

