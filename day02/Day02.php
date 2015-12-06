<?php

class Day02 {

    private $_paperAmount    = 0;
    private $_baseDimensions = 0;
    private $_sides  = array(0);
    private $_side1  = 0;
    private $_side2  = 0;
    private $_side3  = 0;

    private $_boxCount = 0;
    private $_totalPaper = 0;

    public function getPaperAmount($boxes = NULL) { 
        $this->_clearVariables();

        if ($boxes) $this->_getBoxAmounts($boxes);

        return $this->_totalPaper;
    }

    public function outputAllDimensions() {
        echo "Paper: " . $this->_totalPaper . "\n";
        echo "Box Count: " . $this->_boxCount . "\n";
        echo "\nLast Box--\n";
        echo "Box Dimensions: " . $this->_baseDimensions . "\n";
        echo "L: " . $this->_sides[0] . "\n";
        echo "W: " . $this->_sides[1] . "\n";
        echo "H: " . $this->_sides[2] . "\n";
        echo "S1: " . $this->_side1 . "\n";
        echo "S2: " . $this->_side2 . "\n";
        echo "S3: " . $this->_side3 . "\n";
    }

    private function _getBoxAmounts($boxes) {
        $boxes = explode(',', $boxes);

        foreach ($boxes as $box) {
            ++$this->_boxCount;
            $this->_splitDimensions($box);
            $this->_totalPaper += $this->_getPaperAmount();
        }
    }
   


    private function _clearVariables() {
        $this->_paperAmount = 0;
        $this->_baseDimensions = 0;
        $this->_sides = array(0);
        $this->_side1 = 0;
        $this->_side2 = 0;
        $this->_side3 = 0;
        $this->_totalPaper = 0;
    }

    private function _splitDimensions($box) {
            $this->_sides = explode('x', $box);
    }            

    private function _getSideDimensions() {
        $this->_side1 = 2 * $this->_sides[0] * $this->_sides[1];
        $this->_side2 = 2 * $this->_sides[2] * $this->_sides[1];
        $this->_side3 = 2 * $this->_sides[0] * $this->_sides[2];
    }

    private function _getBaseDimensions() {
        $this->_getSideDimensions();

        $this->_baseDimensions = $this->_side1 + $this->_side2 + $this->_side3;
    }

    private function _getPaperAmount() {
        $this->_getBaseDimensions();

        $smallSide = min($this->_side1, $this->_side2, $this->_side3) / 2;

        $this->_paperAmount = $this->_baseDimensions + $smallSide;

        return $this->_paperAmount;
    }

}

if (isset($argv[1])) {
    $day02 = new Day02;

    $day02->getPaperAmount($argv[1]);
    $day02->outputAllDimensions();
}
