<?php

function require_folder ($mysqli) {

    include_once __DIR__.'/../../fns/require_user.php';
    $user = require_user('../../');

    include_once __DIR__.'/../../fns/request_strings.php';
    list($idfolders) = request_strings('idfolders');

    $idfolders = abs((int)$idfolders);

    include_once __DIR__.'/../../fns/Folders/get.php';
    $folder = Folders\get($mysqli, $user->idusers, $idfolders);

    if (!$folder) {
        include_once __DIR__.'/../../fns/redirect.php';
        redirect('..');
    }

    return array($folder, $idfolders);

}
