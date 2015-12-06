<?php

class Day05 {

    private $_niceListCount = 0;
    private $_inString = NULL;

    public function testStrings($inStrings = NULL, $advanced = NULL) {
        $this->_niceListCount = 0;
        $strings = explode(',', $inStrings);

        foreach ($strings as $string) {
            if ($advanced) 
                $this->advancedTestString($string); 
            else 
                $this->testString($string);
        }

        return $this->_niceListCount;
    }

    public function advancedTestString($inString = NULL) {
        $this->_inString = $inString;
        $sort = "naughty";

        if ($this->_isAdvancedNice()) {
            $sort = "nice";
            ++$this->_niceListCount;
        }

        return $sort;
    }

    public function testString($inString = NULL) {
        $this->_inString = $inString;
        $sort = "naughty";

        if ($this->_isNice()) {
            $sort = "nice";
            ++$this->_niceListCount;
        }
        
        return $sort;
    }

    public function getNiceListCount() {
        return $this->_niceListCount;
    }

    private function _isNice() {
        $value = false;

        $enoughVowels  = $this->_hasEnoughVowels();
        $hasDoubles    = $this->_hasDoubles();
        $hasNoBadPairs = $this->_hasNoBadPairs();

        if ($enoughVowels && $hasDoubles && $hasNoBadPairs) $value = true;

        return $value;
    }

    private function _isAdvancedNice() {
        $value = false;

        $hasDuplicatePairsNoOverlap = $this->_hasDuplicatePairsNoOverlap();
        $hasSplitRepeat = $this->_hasSplitRepeat();

        if ($hasDuplicatePairsNoOverlap && $hasSplitRepeat) $value = true;

        return $value;
    }

    private function _hasEnoughVowels() {
        $value = false;

        $count = substr_count($this->_inString, 'a');
        $count += substr_count($this->_inString, 'e');
        $count += substr_count($this->_inString, 'i');
        $count += substr_count($this->_inString, 'o');
        $count += substr_count($this->_inString, 'u');

        if ($count >= 3) $value = true;
        return $value;
    }

    private function _hasDoubles() {
        $value = false;
        $i = 1;

        while ($value == false && $i < strlen($this->_inString)) {
            if ($this->_inString[$i] == $this->_inString[$i-1]) $value = true;
            ++$i;
        }

        return $value;
    }

    private function _hasNoBadPairs() {
        $value = true;

        if (strpos($this->_inString, 'ab') !== false) $value = false;
        if (strpos($this->_inString, 'cd') !== false) $value = false;
        if (strpos($this->_inString, 'pq') !== false) $value = false;
        if (strpos($this->_inString, 'xy') !== false) $value = false;

        return $value;
    }

    private function _hasDuplicatePairsNoOverlap() {
        $value = false;
        $i = 1;

        while ($value == false && $i < strlen($this->_inString)) {
            $pair = substr($this->_inString, $i - 1, 2);
            if (strpos($this->_inString, $pair, $i + 1) !== false) $value = true;
            ++$i;
        }

        return $value;
    }

    private function _hasSplitRepeat() {
        $value = false;
        $i = 2;

        while ($value == false && $i < strlen($this->_inString)) {
            if ($this->_inString[$i] == $this->_inString[$i-2]) $value = true;
            ++$i;
        }

        return $value;
    }
        
        
}

if (isset($argv[1])) {
    $day05 = new Day05;

    if (!isset($argv[2])) $argv[2] = NULL;
    echo $day05->testStrings($argv[1], $argv[2]) . "\n";
    echo $day05->getNiceListCount();
}
