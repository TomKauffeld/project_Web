<?php

class IdGenerator{

    /**
     * @var array $charArr the characters used inside the ids
     */
    private static $charArr = [
        "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z",
        "A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "k", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z",
        "1", "2", "3", "4", "5", "6", "7", "8", "9", "0", "_", "-"
    ];

    /**
     * creates an id
     * @param int $minLenght the minum lenght the id should be
     * @param int $maxLenght the maximum lenght the id should be
     * @return string the randomly generated id
     */
    public static function create( int $minLenght = 50, int $maxLenght = 50){
        $times = random_int( max( $minLenght, 0), min( $maxLenght, 200));
        $string = "";
        while (strlen( $string) < $times){
            $random = random_int( 0, count( $charArr-1));
            $string .= $charArr[$random];
        }
        return $string;
    }

    /**
     * returns the number of charachters
     * @return int
     */
    public static function perChar( ){
        return count( $charArr);
    }
    
}