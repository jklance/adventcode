<?php

class Day01 {

    private $_floor;

    public function travelFloors($path) { 
        $this->_floor = 0;

        for ($i = 0; $i < strlen($path); ++$i) {
            if ($path[$i] == '(') {
                ++$this->_floor;
            } elseif ($path[$i] == ')') {
                --$this->_floor;
            }
        }

        return $this->_floor;
    }
}

if (isset($argv[1])) {
    $day01 = new Day01;
    echo $day01->travelFloors($argv[1]);
}
