<?php
require_once dirname(__FILE__) . '/../Day02.php';

class Day02Tests extends PHPUnit_Framework_TestCase {

    private $_day02;

    function setUp() {
        $this->_day02 = new Day02();
    }

    function testNoDimensions() {
        $this->assertEquals(0, $this->_day02->getPaperAmount());
        $this->assertEquals(0, $this->_day02->getRibbonAmount());
    }

    function testSingleLWH() {
        $this->assertEquals(7, $this->_day02->getPaperAmount("1x1x1"));
        $this->assertEquals(5, $this->_day02->getRibbonAmount());
    }

    function testGivenDimensions() {
        $this->assertEquals(58, $this->_day02->getPaperAmount("2x3x4"));
        $this->assertEquals(34, $this->_day02->getRibbonAmount());
        $this->assertEquals(43, $this->_day02->getPaperAmount("1x1x10"));
        $this->assertEquals(14, $this->_day02->getRibbonAmount());
    }

    function testBulkDimensions() {
        $this->assertEquals(101, $this->_day02->getPaperAmount("2x3x4,1x1x10"));
        $this->assertEquals(48, $this->_day02->getRibbonAmount());
    }

}

