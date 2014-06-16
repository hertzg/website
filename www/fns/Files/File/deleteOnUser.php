<?php

namespace Files\File;

function deleteOnUser ($id_users) {

    include_once __DIR__.'/dir.php';
    $dir = dir($id_users);

    $d = opendir($dir);
    while ($file = readdir($d)) {
        if ($file == '.' || $file == '..') continue;
        unlink("$dir/$file");
    }
    closedir($d);

}
