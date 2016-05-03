<?php

function for_each_user ($callback) {

    include_once __DIR__.'/../../../fns/Users/Directory/dir.php';
    $dir = Users\Directory\dir();

    $d = opendir($dir);
    while ($file = readdir($d)) {
        if ($file == '.' || $file == '..' || !is_dir("$dir/$file")) continue;
        $callback((int)$file);
    }

}
