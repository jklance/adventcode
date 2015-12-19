<?php

class Day08 {

    private $_totalLen = 0;

    public function getTotalReencodeInFile($fileName) {
        $this->_totalLen = 0;

        $inFile = file($fileName, FILE_IGNORE_NEW_LINES);

        foreach ($inFile as $inLine) {
            $this->_totalLen += $this->getReencodeCharacters($inLine);
        }

        return $this->_totalLen;
    }


    public function getTotalCharactersInFile($fileName) {
        $this->_totalLen = 0;

        $inFile = file($fileName, FILE_IGNORE_NEW_LINES);

        foreach ($inFile as $inLine) {
            $this->_totalLen += $this->getTotalCharacters($inLine);
        }

        return $this->_totalLen;
    }

    public function getReencodeCharacters($input) {
        $chrLength = strlen($input);
        $recLength = $chrLength + 4;

        preg_match_all('/(\\\.)/', $input, $escapes);

        foreach($escapes[0] as $escape) {
            if ($escape == '\x') {
                $recLength += 1;
            } else {
                $recLength += 2;
            }
        }

        
        $length = $recLength - $chrLength;
        return $length;
    }        


    public function getTotalCharacters($input) {
        $chrLength = strlen($input); 
        $strLength = $chrLength - 2;

        preg_match_all('/(\\\.)/', $input, $escapes);

        foreach($escapes[0] as $escape) {
            if ($escape == '\x') {
                $strLength -= 3;
            } else {
                $strLength -= 1;
            }
        }

        
        $length = $chrLength - $strLength;
        return $length;
    }

}

if (isset($argv[1])) {
    $day08 = new Day08;

    echo $day08->getTotalReencodeInFile($argv[1]);
}
