<?php

function require_note ($mysqli, $id_users) {

    include_once __DIR__.'/../../../fns/request_strings.php';
    list($id) = request_strings('id');

    $id = abs((int)$id);

    include_once __DIR__.'/../../../fns/Notes/getOnUser.php';
    $note = Notes\getOnUser($mysqli, $id_users, $id);

    if (!$note) {
        include_once __DIR__.'/../../fns/bad_request.php';
        bad_request('The note no longer exists.');
    }

    return [$id, $note];

}
