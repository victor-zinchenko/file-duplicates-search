<?php

/**
 * FilesizeProcessor is used to filter non-duplicating (unique) and based on
 * comparing the file sizes
 *
 * @author luke
 */
class FilesizeProcessor extends Processor
{

    /**
     * Method makes an array of representations based on file sizes
     * @param array $files <p>array with files paths</p>
     * @return array
     */
    protected function getValues(array $files)
    {
        $result = [];
        foreach ($files as $key => $file) {
            $result[$key] = filesize($file);
        }
        return $result;
    }

}
