<?php
require_once dirname(__FILE__) . '/../Day04.php';

class Day04Tests extends PHPUnit_Framework_TestCase {

    private $_day04;

    function setUp() {
        $this->_day04 = new Day04();
    }

    function testEmptyKey() {
        $this->assertEquals('Error', $this->_day04->mineCoins());
    }

    function testGivenKeys() {
        $this->assertEquals(609043, $this->_day04->mineCoins('abcdef'));
        $this->assertEquals(1048970, $this->_day04->mineCoins('pqrstuv'));
    }
}
