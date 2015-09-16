<?php

/**
 * DuplicateFinder is used for search files duplicates
 *
 * @author luke
 */
class DuplicateFinder
{

    /**
     * An array of processors
     * @var array
     */
    private $processors = [];

    /**
     * An array of files to search
     * @var array 
     */
    private $files;

    /**
     * Setting the file list for search
     * @param array $files
     */
    public function __construct($files)
    {
        if (is_array($files)) {
            $this->files = $files;
        } else {
            throw new Exception('No files.');
        }
    }

    /**
     * Method applies all processors stored id $processors array invoking 
     * their method filter for duplicate search
     * @return array
     * @throws Exception
     */
    public function run()
    {
        foreach ($this->processors as $processor) {
            $this->files = $processor->filter($this->files);
        }
        if (empty($this->files)) {
            throw new Exception('No duplicates under this directory');
        }
        return $this->files;
    }

    /**
     * Attaches processor to $processors array
     * @param Processor $processor
     */
    public function attachProcessor(Processor $processor)
    {
        $this->processors[] = $processor;
    }

}
