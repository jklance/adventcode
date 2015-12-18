<?php

class Day07 {

    private $_operand1;
    private $_operand2;
    private $_operation;
    private $_recipient;
    private $_queue;
    private $_queueStatus;

    private $_wires = array();

    public function processOperations($operations = NULL) {
        $this->_wires = array();
        $return = NULL;

        if ($operations) {
            $this->_queue = explode('::', $operations);

            $changed = true; 

            // Repeat so long as there are items in the queue AND we made a change last pass
            // (if we didn't, we're stalled, let's bail on this)
            while ($changed && count($this->_queue > 0)) {
                asort($this->_queue);
                $changed = false;

                foreach ($this->_queue as $k => $operation) {
                    $returnSub = explode(" ", $operation);
                    $returnSub = end($returnSub);
                    $return = $this->processOperation($operation, $returnSub);
                    
                    if ($return) {
                        $changed = true;
                        unset($this->_queue[$k]);
                    }
                }
                echo "\n a: " . $this->_wires['a'] . "\n";
            }
        }

        return $return;
    }

    public function processOperation($operation = NULL, $return = NULL) { 

        if ($operation && $return) {
            $this->_parseOperation($operation);
    
            if (isset($this->_wires[$return])) $return = $this->_wires[$return]; else $return = NULL;
        }

        return $return;
    }

    public function displayValues() {
        echo $this->_operand1 . $this->_operation . $this->_operand2 . "->" . $this->_recipient . "\n";

        echo "Wires:\n";
        ksort($this->_wires);
        foreach ($this->_wires as $label => $wire) {
            echo " $label: $wire\n";
        }
    }


    private function _parseOperation($operation) {
        $parts = explode('->', $operation);
        $this->_recipient = trim($parts[1]);

        $this->_handleLeftSide($parts[0]);
        $this->_performOperation();
    }

    private function _handleLeftSide($leftSide) {
        $parts = explode(' ', trim($leftSide));

        if (count($parts) == 1) {
            $this->_operand1  = trim($parts[0]);
            $this->_operand2  = NULL;
            $this->_operation = NULL;
        } elseif (count($parts) == 2) {
            $this->_operand1  = trim($parts[1]);
            $this->_operand2  = NULL;
            $this->_operation = trim($parts[0]);
        } elseif (count($parts) == 3) {
            $this->_operand1  = trim($parts[0]);
            $this->_operand2  = trim($parts[2]);
            $this->_operation = trim($parts[1]);
        }
    }

    private function _performOperation() {
        $this->_checkOperands();

        switch ($this->_operation) {
            case NULL:
                $this->_performAssignment();
                break;
            case 'AND':
                $this->_performAnd();
                break;
            case 'OR':
                $this->_performOr();
                break;
            case 'LSHIFT':
                $this->_performLshift();
                break;
            case 'RSHIFT':
                $this->_performRshift();
                break;
            case 'NOT':
                $this->_performNot();
                break;
            case 'CLEAR':
                $this->_performClear();
                break;
        }
    }

    private function _checkOperands() {
        if (!is_numeric($this->_operand1)) {
            if (isset($this->_wires[$this->_operand1])) {
                $this->_operand1 = $this->_wires[$this->_operand1];
            } else {
                $this->_operand1 = NULL;
            }
        }
        if (!is_numeric($this->_operand2)) {
            if (isset($this->_wires[$this->_operand2])) {
                $this->_operand2 = $this->_wires[$this->_operand2];
            } else {
                $this->_operand2 = NULL;
            }
        }
    }

    private function _performAssignment() {
        if ($this->_operand1 !== NULL) 
            $this->_wires[$this->_recipient] = $this->_operand1;
    }
    
    private function _performAnd() {
        if ($this->_operand1 !== NULL && $this->_operand2 !== NULL) 
            $this->_wires[$this->_recipient] = intval($this->_operand1) & intval($this->_operand2);
    }

    private function _performOr() {
        if ($this->_operand1 !== NULL && $this->_operand2 !== NULL) 
            $this->_wires[$this->_recipient] = intval($this->_operand1) | intval($this->_operand2);
    }

    private function _performLshift() {
        if ($this->_operand1 !== NULL && $this->_operand2 !== NULL) 
            $this->_wires[$this->_recipient] = intval($this->_operand1) << intval($this->_operand2);
    }

    private function _performRshift() {
        if ($this->_operand1 !== NULL && $this->_operand2 !== NULL) 
            $this->_wires[$this->_recipient] = intval($this->_operand1) >> intval($this->_operand2);
    }

    private function _performNot() {
        if ($this->_operand1 !== NULL) 
            // This is a 16b machine, so we have to mask this to 16b..that was annoying to figure out
            $this->_wires[$this->_recipient] = (~ intval($this->_operand1)) & ((1 << 16) -1);
    }

    private function _performClear() {
        foreach ($this->_wires as $k => $v) {
            if ($k != $this->_recipient) 
                $this->_wires[$k] = 0;
        }
    }


}

if (isset($argv[1])) {
    $day07 = new Day07;
    $day07->processOperations($argv[1]) . "\n";
    //$day07->displayValues();

}
