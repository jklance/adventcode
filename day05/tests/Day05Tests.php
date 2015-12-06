<?php
require_once dirname(__FILE__) . '/../Day05.php';

class Day05Tests extends PHPUnit_Framework_TestCase {

    private $_day05;

    function setUp() {
        $this->_day05 = new Day05();
    }

    function testEmptyString() {
        $this->assertEquals("naughty", $this->_day05->testString());
    }

    function testThreeVowelsWithDouble() {
        $this->assertEquals("nice", $this->_day05->testString('aagdi'));
    }

    function testHasOutlawedStrings() {
        $this->assertEquals("naughty", $this->_day05->testString('aabei'));
        $this->assertEquals("naughty", $this->_day05->testString('acdei'));
        $this->assertEquals("naughty", $this->_day05->testString('apqei'));
        $this->assertEquals("naughty", $this->_day05->testString('axyei'));
    }

    function testGivenStrings() {
        $this->assertEquals("nice", $this->_day05->testString('ugknbfddgicrmopn'));
        $this->assertEquals("nice", $this->_day05->testString('aaa'));
        $this->assertEquals("naughty", $this->_day05->testString('jchzalrnumimnmhp'));
        $this->assertEquals("naughty", $this->_day05->testString('haegwjzuvuyypxyu'));
        $this->assertEquals("naughty", $this->_day05->testString('dvszwmarrgswjxmb'));
    }
    
    function testBulkEntry() {
        $this->assertEquals(2, $this->_day05->testStrings('ugknbfddgicrmopn,aaa,jchzalrnumimnmhp,haegwjzuvuyypxyu,dvszwmarrgswjxmb'));
    }

    function testAdvancedEmptyString() {
        $this->assertEquals("naughty", $this->_day05->advancedTestString());
    }

    function testDuplicateWithNoOverlapAndSplitRepeat() {
        $this->assertEquals("nice", $this->_day05->advancedTestString('xyxy'));
        $this->assertEquals("naughty", $this->_day05->advancedTestString('aabcdefgaa'));
        $this->assertEquals("naughty", $this->_day05->advancedTestString('aaa'));
    }
    
    function testAdvancedGivenStrings() {
        $this->assertEquals("nice", $this->_day05->advancedTestString('qjhvhtzxzqqjkmpb'));
        $this->assertEquals("nice", $this->_day05->advancedTestString('xxyxx'));
        $this->assertEquals("naughty", $this->_day05->advancedTestString('uurcxstgmygtbstg'));
        $this->assertEquals("naughty", $this->_day05->advancedTestString('ieodomkazucvgmuy'));
    }

    function testBulkAdvancedEntry() {
        $this->assertEquals(2, $this->_day05->testStrings(
            'qjhvhtzxzqqjkmpb,xxyxx,uurcxstgmygtbstg,ieodomkazucvgmuy', true)
        );
    }

}

