<?php

class Day04 {

    private $_hash = NULL;

    public function mineCoins($key = NULL, $digits = 5) { 
        if (!$key) return 'Error';

        $n = 0;
        $match = $this->_getHeadMatch($digits);
        $head = NULL;

        do {
            ++$n;
            $head = $this->_getHashedHead($key, $n, $digits);
        } while ($head !== $match);

        return $n;
    }

    public function getStoredHash() {
        return $this->_hash;
    }

    private function _getHashedHead($key, $n, $digits) {
        $this->_hash = $this->_hashKey($key, $n);
        $head = substr($this->_hash, 0, $digits);

        return $head;
    }

    private function _hashKey($key, $n) {
        return md5($key . $n);
    }

    private function _getHeadMatch($digits) {
        $match = "";

        while (strlen($match) < $digits) {
            $match .= '0';
        }

        return $match;
    }

}

if (isset($argv[1])) {
    $day04 = new Day04;

    $match = 5;
    if (isset($argv[2])) $match = $argv[2];

    echo $day04->mineCoins($argv[1], $match) . "\n";
    echo "\nHash: " . $day04->getStoredHash() . "\n";
}
