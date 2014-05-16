<?php

function require_file ($mysqli, $id_users) {

    include_once __DIR__.'/../../../fns/request_strings.php';
    list($id) = request_strings('id');

    $id = abs((int)$id);

    include_once __DIR__.'/../../../fns/Files/get.php';
    $file = Files\get($mysqli, $id_users, $id);

    if (!$file) {
        include_once __DIR__.'/../../fns/bad_request.php';
        bad_request('FILE_NOT_FOUND');
    }

    return $file;

}
