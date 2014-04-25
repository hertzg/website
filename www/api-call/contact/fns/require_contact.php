<?php

function require_contact ($mysqli, $id_users) {

    include_once __DIR__.'/../../../fns/request_strings.php';
    list($id) = request_strings('id');

    $id = abs((int)$id);

    include_once __DIR__.'/../../../fns/Contacts/getOnUser.php';
    $contact = Contacts\getOnUser($mysqli, $id_users, $id);

    if (!$contact) {
        include_once __DIR__.'/../../fns/bad_request.php';
        bad_request('CONTACT_NOT_FOUND');
    }

    return [$id, $contact];

}
