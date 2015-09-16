<?php

/**
 * FilesystemProvider is used for recursive search for all files in directory
 *
 * @author luke
 */
class FilesystemProvider implements DataProviderInterface
{

    private $directory;

    /**
     * Setting the directory for search
     * @param string $directory
     */
    public function __construct($directory)
    {
        if (is_dir($directory)) {
            $this->directory = $directory;
        } else {
            throw new Exception('Bad directory');
        }
    }

    /**
     * Recursively search for files in directory
     * @return mixed: array of files on success or false otherwise
     */
    public function getFiles()
    {
        $results = false;

        // Create iterators
        $dirIterator = new RecursiveDirectoryIterator($this->directory, RecursiveDirectoryIterator::SKIP_DOTS);
        $iteratorIterator = new RecursiveIteratorIterator($dirIterator, RecursiveIteratorIterator::SELF_FIRST);

        foreach ($iteratorIterator as $item) {

            // Get path. If it is a file add it results array
            $subPath = $iteratorIterator->getSubPathName();
            if (!$item->isDir()) {
                $results[] = $this->directory . $subPath;
            }
        }

        return $results;
    }

}
