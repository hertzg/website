<?php

function require_contact ($mysqli, $id_users) {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/request_strings.php";
    list($id) = request_strings('id');

    $id = abs((int)$id);

    include_once "$fnsDir/Contacts/getOnUser.php";
    $contact = Contacts\getOnUser($mysqli, $id_users, $id);

    if (!$contact) {
        include_once __DIR__.'/../../fns/bad_request.php';
        bad_request('CONTACT_NOT_FOUND');
    }

    return $contact;

}
