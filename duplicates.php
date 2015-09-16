<?php

//error_reporting(E_ALL);
//ini_set('display_errors', 1);
// Autoload required files
define('ROOT', dirname(__FILE__));
require_once(ROOT . '/components/autoload.php');

// Directory for search
$directory = ROOT . "/scandir/";
if (isset($argv[1])) {
    $directory = $argv[1];
}

try {
    // Get all files
    $dataProvider = new DataProvider(new FilesystemProvider($directory));
    $filesArray = $dataProvider->getFiles();

    // Instantiate DuplicateFinder with specified processors and retrieve duplicates
    $duplicateFinder = new DuplicateFinder($filesArray);
    $duplicateFinder->attachProcessor(new FilesizeProcessor());
    $duplicateFinder->attachProcessor(new HashProcessor('adler32'));
    $duplicateFinder->attachProcessor(new HashProcessor('md5'));
    $duplicateFinder->attachProcessor(new HashProcessor('crc32'));
    $duplicates = $duplicateFinder->run();

    // Now you are free to deal with $duplicates. Sure, I can save it to the file
    $text = '';
    foreach ($duplicates as $item) {
        $text .= $item . PHP_EOL;
    }
    file_put_contents('duplicates.txt', $text);

    echo 'Success: duplicates paths written to duplicates.txt'. PHP_EOL;

} catch (Exception $e) {
    echo 'Message: ' . $e->getMessage() . PHP_EOL;
}



