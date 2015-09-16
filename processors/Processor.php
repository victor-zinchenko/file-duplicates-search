<?php

/**
 * Processor is a basic abstract class for extending by custom processors
 *
 * @author luke
 */
abstract class Processor
{

    /**
     * Method for getting representation (hashes, etc.) of files stored in $files 
     * $array using custom logic
     */
    abstract protected function getValues(array $files);

    /**
     * Method used to filter non-duplicating (unique) files using custom 
     * representations
     * @param array $files
     * @return array
     */
    public function filter(array $files)
    {
        $values = $this->getValues($files);

        $nonUniqueKeys = $this->getNonUniqueKeys($files, $values);

        $result = [];
        foreach ($nonUniqueKeys as $key) {
            $result[] = $files[$key];
        }
        return $result;
    }

    /**
     * Returns non unique keys of $files array
     * @param array $files <p>array to search</p>
     * @param array $values <p>Representation values</p>
     * @return array
     */
    protected function getNonUniqueKeys($files, $values)
    {
        $nonUniqueValues = $this->getNonUniqueValues($values);

        $duplicateKeys = [];

        foreach ($values as $key => $item) {
            if (in_array($item, $nonUniqueValues)) {
                $duplicateKeys[] = $key;
            }
        }

        return $duplicateKeys;
    }

    /**
     * Returns non unique representations (values)
     * @param array $files <p>array to search</p>
     * @return array
     */
    protected function getNonUniqueValues($values)
    {
        $uniqueValues = array_unique($values);
        return array_unique(array_diff_key($values, $uniqueValues));
    }

}
