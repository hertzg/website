<?php

namespace ReceivedFiles\File;

function deleteOnReceiver ($receiver_id_users) {

    include_once __DIR__.'/dir.php';
    $dir = dir($receiver_id_users);

    $d = opendir($dir);
    while ($file = readdir($d)) {
        if ($file == '.' || $file == '..') continue;
        unlink("$dir/$file");
    }
    closedir($d);

}
