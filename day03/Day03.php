<?php

class Day03 {

    private $_houses = 0;
    private $_deliveries = 0; 
    private $_world = array();
    private $_roboDelivery = false;

    public function deliverPresents($path = NULL) { 
        $this->_resetWorld();   
        $this->_incrementLocation(0,0); //Always deliver where we are at least

        if ($this->_roboDelivery) $this->_incrementLocation(0,0); // Robot santa must deliver

        if ($path) $this->_processInstructions($path);

        return $this->_houses;
    }

    public function roboDeliverPresents($path = NULL) {
        $this->_roboDelivery = true;
        
        $this->deliverPresents($path);

        return $this->_houses;
    }

    public function outputValues() {
        echo "Houses: " . $this->_houses . "\n";
        echo "Deliveries: " . $this->_deliveries . "\n";
    }

    private function _processInstructions($path) {
        $santa = array( 'ns' => 0, 'ew' => 0);
        $robot = array( 'ns' => 0, 'ew' => 0);

        for ($i = 0; $i < strlen($path); ++$i) {
            if ($this->_getMover($i) == "santa") {
                switch ($path[$i]) {
                    case '^':
                        ++$santa['ns'];
                        break;
                    case 'v':
                        --$santa['ns'];
                        break;
                    case '>':
                        ++$santa['ew'];
                        break;
                    case '<':
                        --$santa['ew'];
                        break;
                }
            
                $this->_incrementLocation($santa['ns'], $santa['ew']);
            } else {
                switch ($path[$i]) {
                    case '^':
                        ++$robot['ns'];
                        break;
                    case 'v':
                        --$robot['ns'];
                        break;
                    case '>':
                        ++$robot['ew'];
                        break;
                    case '<':
                        --$robot['ew'];
                        break;
                }
                
                $this->_incrementLocation($robot['ns'], $robot['ew']);
            }

        }
    }

    private function _resetWorld() {
        unset($this->_world);
        $this->_world = array();

        $this->_houses = 0;
        $this->_deliveries = 0;
    }

    private function _incrementLocation($ns, $ew) {
        if (!isset($this->_world[$ns])) $this->_world[$ns][$ew] = 0;
        if (!isset($this->_world[$ns][$ew])) $this->_world[$ns][$ew] = 0;
        if (!$this->_world[$ns][$ew]) ++$this->_houses;
        ++$this->_world[$ns][$ew];
        ++$this->_deliveries;
    }

    private function _getMover($n) {
        $mover = "robot";
        if (!$this->_roboDelivery) $mover = "santa";
        if ($n % 2 == 0) $mover = "santa";

        return $mover;
    }


}

if (isset($argv[1])) {
    $day03 = new Day03;
    if (isset($argv[2])) 
        $day03->roboDeliverPresents($argv[1]); 
    else 
        $day03->deliverPresents($argv[1]);
    $day03->outputValues();
}
