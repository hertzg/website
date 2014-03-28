<?php

function require_note ($mysqli) {

    include_once __DIR__.'/../../fns/require_user.php';
    $user = require_user('../../');

    include_once __DIR__.'/../../fns/request_strings.php';
    list($id) = request_strings('id');

    $id = abs((int)$id);

    include_once __DIR__.'/../../fns/Notes/get.php';
    $note = Notes\get($mysqli, $user->idusers, $id);

    if (!$note) {
        unset($_SESSION['notes/messages']);
        $_SESSION['notes/errors'] = [
            'The note no longer exists.',
        ];
        include_once __DIR__.'/../../fns/redirect.php';
        redirect('..');
    }

    return [$note, $id, $user];

}
