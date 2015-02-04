<?php

function require_note ($mysqli, $id_users) {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/request_strings.php";
    list($id) = request_strings('id');

    $id = abs((int)$id);

    include_once "$fnsDir/Notes/getOnUser.php";
    $note = Notes\getOnUser($mysqli, $id_users, $id);

    if (!$note) {
        include_once __DIR__.'/../../fns/bad_request.php';
        bad_request('NOTE_NOT_FOUND');
    }

    return $note;

}
