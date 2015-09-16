<?php

/**
 * HashProcessor is used to filter non-duplicating (unique) and based on
 * comparing the hashes obtained with specified algorithm
 *
 * @author luke
 */
class HashProcessor extends Processor
{

    /**
     * Algorithm which is used to obtain hash
     * @var string 
     */
    private $algo;

    /**
     * Constructor. Is used to set algorithm
     * @param string $algo
     */
    public function __construct($algo = 'adler32')
    {
        $this->algo = $algo;
    }

    /**
     * Method makes an array of representations (hashes) calculated using 
     * specified algorithm
     * @param array $files <p>array with files paths</p>
     * @return array
     */
    protected function getValues(array $files)
    {
        $hashes = [];
        foreach ($files as $file) {
            $hashes[] = hash_file($this->algo, $file);
        }
        return $hashes;
    }

}
