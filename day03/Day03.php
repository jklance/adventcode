<?php

class Day03 {

    private $_houses = 0;
    private $_deliveries = 0; 
    private $_world = array();

    public function deliverPresents($path = NULL) { 
        $this->_resetWorld();   
        $this->_incrementLocation(0,0); //Always deliver where we are at least

        if ($path) $this->_processInstructions($path);

        return $this->_houses;
    }

    public function outputValues() {
        echo "Houses: " . $this->_houses . "\n";
        echo "Deliveries: " . $this->_deliveries . "\n";
    }

    private function _processInstructions($path) {
        $ns = 0;
        $ew = 0;

        for ($i = 0; $i < strlen($path); ++$i) {
            switch ($path[$i]) {
                case '^':
                    ++$ns;
                    break;
                case 'v':
                    --$ns;
                    break;
                case '>':
                    ++$ew;
                    break;
                case '<':
                    --$ew;
                    break;
            }

            $this->_incrementLocation($ns, $ew);
        }
    }

    private function _resetWorld() {
        unset($this->_world);
        $this->_world = array();
    }

    private function _incrementLocation($ns, $ew) {
        if (!isset($this->_world[$ns])) $this->_world[$ns][$ew] = 0;
        if (!isset($this->_world[$ns][$ew])) $this->_world[$ns][$ew] = 0;
        if (!$this->_world[$ns][$ew]) ++$this->_houses;
        ++$this->_world[$ns][$ew];
        ++$this->_deliveries;
    }

}

if (isset($argv[1])) {
    $day03 = new Day03;
    $day03->deliverPresents($argv[1]);
    $day03->outputValues();
}
