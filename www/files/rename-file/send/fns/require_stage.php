<?php

function require_stage ($mysqli) {

    include_once __DIR__.'/../../../fns/require_file.php';
    list($file, $id, $user) = require_file($mysqli, '../');

    $key = 'files/rename-file/values';
    if (!array_key_exists($key, $_SESSION)) {
        include_once __DIR__.'/../../../../fns/redirect.php';
        redirect("../?id=$id");
    }

    return [$user, $_SESSION[$key], $id, $file];

}
