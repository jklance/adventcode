<?php

class Day04 {

    private $_hash = NULL;

    public function mineCoins($key = NULL) { 
        if (!$key) return 'Error';

        $n = 0;
        $firstFive = NULL;

        do {
            ++$n;
            $firstFive = $this->_getHashedFirstFive($key, $n);
        } while ($firstFive !== '00000');

        return $n;
    }

    public function getStoredHash() {
        return $this->_hash;
    }

    private function _getHashedFirstFive($key, $n) {
        $this->_hash = $this->_hashKey($key, $n);
        $firstFive = substr($this->_hash, 0, 5);

        return $firstFive;
    }

    private function _hashKey($key, $n) {
        return md5($key . $n);
    }

}

if (isset($argv[1])) {
    $day04 = new Day04;
    echo $day04->mineCoins($argv[1]) . "\n";
    echo "\nHash: " . $day04->getStoredHash() . "\n";
}
