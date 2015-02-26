<?php

function require_contact ($mysqli, $user) {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/request_strings.php";
    list($id) = request_strings('id');

    $id = abs((int)$id);

    include_once "$fnsDir/Users/Contacts/get.php";
    $contact = Users\Contacts\get($mysqli, $user, $id);

    if (!$contact) {
        include_once __DIR__.'/../../fns/bad_request.php';
        bad_request('CONTACT_NOT_FOUND');
    }

    return $contact;

}
