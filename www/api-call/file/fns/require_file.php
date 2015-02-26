<?php

function require_file ($mysqli, $user) {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/request_strings.php";
    list($id) = request_strings('id');

    $id = abs((int)$id);

    include_once "$fnsDir/Users/Files/get.php";
    $file = Users\Files\get($mysqli, $user, $id);

    if (!$file) {
        include_once __DIR__.'/../../fns/bad_request.php';
        bad_request('FILE_NOT_FOUND');
    }

    return $file;

}
