<?php

class Day06 {

    private $_lightField = array();
    private $_instruction = NULL;
    private $_nordicMode = false;

    private $_keyword = NULL;
    private $_start   = array();
    private $_end     = array();

    function Day06() {
        for ($r = 0; $r < 1000; ++$r) {
            for ($c = 0; $c < 1000; ++$c) {
                $this->_lightField[$r][$c] = 0;
            }
        }
    }

    public function sendNordicInstructions($instruction = NULL) {
        $this->_nordicMode = true;

        $this->sendInstructions($instruction);

        return $this->getLightCount();
    }

    public function sendInstructions($instructions = NULL) {
        $this->Day06(); // Clear the field
        $instructionSet = explode('::', $instructions);

        foreach ($instructionSet as $instruction) {
            $this->sendInstruction($instruction);
        }

        return $this->getLightCount();
    }

    public function sendNordicInstruction($instruction = NULL) {
        $this->_nordicMode = true;

        $this->sendInstruction($instruction);

        return $this->getLightCount();
    }

    public function sendInstruction($instruction = NULL) {
        $this->_instruction = $instruction;

        if ($instruction) {
            $this->_parseInstruction();
            $this->_executeInstruction();
        }
        
        return $this->getLightCount();
    }

    public function getLightCount() {
        $count = 0;

        foreach ($this->_lightField as $row) {
            $count += array_sum($row);
        }

        return $count;
    }
        

    public function displayLightGrid() {
        foreach ($this->_lightField as $row) {
            foreach ($row as $column) {
                echo $column;
            }
            echo "\n";
        }
        echo "\n";
    }

    public function displayValues() {
        echo "Instruction: " . $this->_instruction . "\n";
        echo $this->_keyword . ": " . $this->_start[0] . "," . $this->_start[1] . "--" . $this->_end[0] . "," . $this->_end[1] . "\n";
        echo "Brightness: " . $this->getLightCount() . "\n";
    }

    private function _parseInstruction() {
        $this->_getKeyword();
        
        $words = explode(' ', $this->_instruction);
        $this->_getStartCoord($words);
        $this->_getEndCoord($words);
    }

    private function _getKeyword() {
        if (!$this->_nordicMode) {
            if (strpos($this->_instruction, 'toggle') === 0) 
                $this->_keyword = 'toggle';
            elseif (strpos($this->_instruction, 'turn on') === 0)
                $this->_keyword = 'on';
            elseif (strpos($this->_instruction, 'turn off') === 0) 
                $this->_keyword = 'off';
        } else {
            if (strpos($this->_instruction, 'toggle') === 0) 
                $this->_keyword = 'nord_toggle';
            elseif (strpos($this->_instruction, 'turn on') === 0)
                $this->_keyword = 'nord_on';
            elseif (strpos($this->_instruction, 'turn off') === 0) 
                $this->_keyword = 'nord_off';
        }
    }

    private function _getStartCoord($words) {
        $offset = 2;
        if ($this->_keyword == 'toggle' || $this->_keyword == 'nord_toggle') $offset = 1;

        $coord = $words[$offset];
        $this->_start = explode(',', $coord);
    }

    private function _getEndCoord($words) {
        $coord = $words[count($words) - 1];
        $this->_end = explode(',', $coord);
    }

    private function _executeInstruction() {
        for ($r = $this->_start[0]; $r <= $this->_end[0]; ++$r) {
            for ($c = $this->_start[1]; $c <= $this->_end[1]; ++$c) {
                switch ($this->_keyword) {
                    case "on":
                        $this->_lightField[$r][$c] = 1;
                        break;
                    case "off":
                        $this->_lightField[$r][$c] = 0;
                        break;
                    case "toggle":
                        $this->_lightField[$r][$c] = abs(--$this->_lightField[$r][$c]);
                        break;
                    case "nord_on":
                        $this->_lightField[$r][$c] += 1;
                        break;
                    case "nord_off":
                        $this->_lightField[$r][$c] -= 1;
                        if ($this->_lightField[$r][$c] < 0) $this->_lightField[$r][$c] = 0;
                        break;
                    case "nord_toggle":
                        $this->_lightField[$r][$c] += 2;
                        break;
                }
            }
        }
    }




}

if (isset($argv[1])) {
    $day06 = new Day06;
    $day06->sendNordicInstructions($argv[1]) . "\n";
    $day06->displayValues();
    //$day06->displayLightGrid();
}
