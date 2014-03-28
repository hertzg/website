<?php

function require_contact ($mysqli) {

    include_once __DIR__.'/../../fns/require_user.php';
    $user = require_user('../../');

    include_once __DIR__.'/../../fns/request_strings.php';
    list($id) = request_strings('id');

    $id = abs((int)$id);

    include_once __DIR__.'/../../fns/Contacts/get.php';
    $contact = Contacts\get($mysqli, $user->idusers, $id);

    if (!$contact) {
        unset($_SESSION['contacts/messages']);
        $_SESSION['contacts/errors'] = [
            'The contact no longer exists.',
        ];
        include_once __DIR__.'/../../fns/redirect.php';
        redirect('..');
    }

    return [$contact, $id, $user];

}
