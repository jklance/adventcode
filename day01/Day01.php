<?php

class Day01 {

    private $_floor;
    private $_basementPosition; 

    public function travelFloors($path) { 
        $this->_floor = 0;
        $this->_basementPosition = "None";

        for ($i = 0; $i < strlen($path); ++$i) {
            if ($path[$i] == '(') {
                ++$this->_floor;
            } elseif ($path[$i] == ')') {
                --$this->_floor;
            }

            if ($this->_firstTimeInBasement()) {
                $this->_basementPosition = $i + 1;
            }
        }
        
        return $this->_floor;
    }

    public function getBasementEntry() {
        return $this->_basementPosition;
    }

    private function _firstTimeInBasement() {
        $first = false;

        if ($this->_floor < 0 && $this->_basementPosition == "None") $first = true;

        return $first;
    }
}

if (isset($argv[1])) {
    $day01 = new Day01;
    echo $day01->travelFloors($argv[1]) . "\n";
    echo $day01->getBasementEntry();
}
