<?php

function for_each_user ($callback) {
    $dir = __DIR__.'/../../../../users';
    $d = opendir($dir);
    while ($file = readdir($d)) {
        if ($file == '.' || $file == '..' || !is_dir("$dir/$file")) continue;
        $callback((int)$file);
    }
}
