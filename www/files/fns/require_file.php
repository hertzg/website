<?php

function require_file ($mysqli) {

    include_once __DIR__.'/../../fns/require_user.php';
    $user = require_user('../../');

    include_once __DIR__.'/../../fns/request_strings.php';
    list($id) = request_strings('id');

    $id = abs((int)$id);

    include_once __DIR__.'/../../fns/Files/get.php';
    $file = Files\get($mysqli, $user->idusers, $id);

    if (!$file) {
        include_once __DIR__.'/../../fns/redirect.php';
        redirect('..');
    }

    return array($file, $id);

}

include_once __DIR__.'/../../lib/user.php';
