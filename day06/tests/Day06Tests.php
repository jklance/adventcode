<?php
require_once dirname(__FILE__) . '/../Day06.php';

class Day06Tests extends PHPUnit_Framework_TestCase {

    private $_day06;

    function setUp() {
        $this->_day06 = new Day06();
    }

    function testTurnOffAllLights() {
        $this->assertEquals(0, $this->_day06->sendInstruction('turn off 0,0 through 999,999'));
    }

    function testTurnOnAllLights() {
        $this->assertEquals(1000000, $this->_day06->sendInstruction('turn on 0,0 through 999,999'));
    }

    function testToggleLights() {
        $this->assertEquals(0, $this->_day06->sendInstruction('turn off 0,0 through 999,999'));
        $this->assertEquals(1000000, $this->_day06->sendInstruction('toggle 0,0 through 999,999'));
        $this->assertEquals(0, $this->_day06->sendInstruction('toggle 0,0 through 999,999'));
    }

    function testGivenSets() {
        $this->assertEquals(1000, $this->_day06->sendInstruction('toggle 0,0 through 999,0'));
    }

    function testBulkSets() {
        $this->assertEquals(90, $this->_day06->sendInstructions(
            'turn on 0,0 through 9,9::toggle 0,0 through 9,0'
        ));
    }

}

