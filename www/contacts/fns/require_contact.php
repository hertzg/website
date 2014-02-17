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
        include_once __DIR__.'/../../fns/redirect.php';
        redirect('..');
    }

    return array($contact, $id);

}

include_once __DIR__.'/../../lib/user.php';
