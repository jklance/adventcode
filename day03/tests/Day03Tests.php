<?php
require_once dirname(__FILE__) . '/../Day03.php';

class Day03Tests extends PHPUnit_Framework_TestCase {

    private $_day03;

    function setUp() {
        $this->_day03 = new Day03();
    }

    function testEmptyPath() {
        $this->assertEquals(1, $this->_day03->deliverPresents());
    }

    function testSingleInstruction() {
        $this->assertEquals(2, $this->_day03->deliverPresents('^'));
    }

    function testGivenInstructions() {
        $this->assertEquals(2, $this->_day03->deliverPresents('>'));
        //$this->assertEquals(4, $this->_day03->deliverPresents('^>v<'));
        //$this->assertEquals(2, $this->_day03->deliverPresents('^v^v^v^v^v'));
    }

}

