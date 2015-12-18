<?php
require_once dirname(__FILE__) . '/../Day07.php';

class Day07Tests extends PHPUnit_Framework_TestCase {

    private $_day07;

    function setUp() {
        $this->_day07 = new Day07();
    }

    function testEmptyPath() {
        $this->assertEquals(NULL, $this->_day07->processOperation());
    }

    function testSinglePaths() {
        $this->assertEquals(123, $this->_day07->processOperation('123 -> x', 'x'));
        $this->assertEquals(456, $this->_day07->processOperation('456 -> y', 'y'));
        $this->assertEquals(72, $this->_day07->processOperation('123 AND 456 -> d', 'd'));
        $this->assertEquals(507, $this->_day07->processOperation('123 OR 456 -> e', 'e'));
        $this->assertEquals(1824, $this->_day07->processOperation('456 LSHIFT 2 -> f', 'f'));
        $this->assertEquals(114, $this->_day07->processOperation('456 RSHIFT 2 -> g', 'g'));
        $this->assertEquals(65079, $this->_day07->processOperation('NOT 456 -> h', 'h'));
    }

    function testStreamOfPaths() {
        $this->assertEquals(65079, $this->_day07->processOperations('123 -> x::456 -> y::x AND y -> d::x OR y -> e::x LSHIFT 2 -> f::y RSHIFT 2 -> g::NOT x -> h::NOT y -> i'));
    }

    function testLongWireNames() {
        $this->assertEquals(65079, $this->_day07->processOperations('123 -> xx::456 -> yy::xx AND yy -> dd::xx OR yy -> ee::xx LSHIFT 2 -> ff::yy RSHIFT 2 -> gg::NOT xx -> hh::NOT yy -> ii'));
    }

    function testWireToWireTransfer() {
        $this->assertEquals(100, $this->_day07->processOperations('100 -> ab::ab -> i'));
    }

    function testMissingInputs() {
        $this->assertEquals(NULL, $this->_day07->processOperation('a -> x', 'x'));
    }

}

