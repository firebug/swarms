<?php
define('EXTENSIONS_PATH', 'extensions/');

try {
    $dir = new DirectoryIterator(realpath(EXTENSIONS_PATH));
    foreach($dir as $file)
    {
        if(!$file->isDot())
            unlink(EXTENSIONS_PATH.$file->getFilename());
    }
} catch (Exception $e) {
    // The directory is expected to be empty
}
?>