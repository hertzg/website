<?php

function require_stage ($mysqli, $base = '') {

    include_once __DIR__.'/../../../fns/require_folder.php';
    list($folder, $id, $user) = require_folder($mysqli, "$base../");

    $key = 'files/rename-folder/send/folder';
    if (!array_key_exists($key, $_SESSION)) {
        include_once __DIR__.'/../../../../fns/redirect.php';
        redirect("$base../?id_folders=$id");
    }

    return [$user, $_SESSION[$key], $id, $folder];

}
