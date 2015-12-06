<?php
require_once dirname(__FILE__) . '/../Day01.php';

class Day01Tests extends PHPUnit_Framework_TestCase {

    private $_day01;

    function setUp() {
        $this->_day01 = new Day01();
    }

    function testEmptyPath() {
        $this->assertEquals(0, $this->_day01->travelFloors(''));
    }

    function testSingleUpParens() {
        $this->assertEquals(1, $this->_day01->travelFloors('('));
    }

    function testSingleDownParens() {
        $this->assertEquals(-1, $this->_day01->travelFloors(')'));
    }

    function testGivenPaths() {
        $this->assertEquals(0, $this->_day01->travelFloors('(())'));
        $this->assertEquals(0, $this->_day01->travelFloors('()()'));
        $this->assertEquals(3, $this->_day01->travelFloors('((('));
        $this->assertEquals(3, $this->_day01->travelFloors('(()(()('));
        $this->assertEquals(3, $this->_day01->travelFloors('))((((('));
        $this->assertEquals(-1, $this->_day01->travelFloors('())'));
        $this->assertEquals(-1, $this->_day01->travelFloors('))('));
        $this->assertEquals(-3, $this->_day01->travelFloors(')))'));
        $this->assertEquals(-3, $this->_day01->travelFloors(')())())'));
    }

    function testBasementPosition() {
        $this->_day01->travelFloors(')');
        $this->assertEquals(1, $this->_day01->getBasementEntry());
    }

    function testNoBasementPosition() {
        $this->_day01->travelFloors('(');
        $this->assertEquals("None", $this->_day01->getBasementEntry());
    }

    function testRepeatedBasementPosition() {
        $this->_day01->travelFloors(')((())()))');
        $this->assertEquals(1, $this->_day01->getBasementEntry());
    }

    function testGivenPositions() {
        $this->_day01->travelFloors('()())');
        $this->assertEquals(5, $this->_day01->getBasementEntry());
    }
}

