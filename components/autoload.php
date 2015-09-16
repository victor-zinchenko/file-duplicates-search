<?php

/**
 * Autoload function. Makes search for needed class in specified folders
 * @param string $className
 */
function __autoload($className)
{
    // Folders for search
    $arrayParts = array(
        '/providers/',
        '/processors/',
    );
    // Include specified class if it exists
    foreach ($arrayParts as $path) {
        $path = ROOT . $path . $className . '.php';
        if (is_file($path)) {
            include_once $path;
        }
    }
}
