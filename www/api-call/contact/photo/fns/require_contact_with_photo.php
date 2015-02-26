<?php

function require_contact_with_photo ($mysqli, $user) {

    include_once __DIR__.'/../../fns/require_contact.php';
    $contact = require_contact($mysqli, $user);

    if (!$contact->photo_id) {
        include_once __DIR__.'/../../../fns/bad_request.php';
        bad_request('NO_PHOTO');
    }

    return $contact;

}
