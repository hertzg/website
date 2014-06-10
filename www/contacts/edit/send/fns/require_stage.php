<?php

function require_stage ($mysqli) {

    include_once __DIR__.'/../../../fns/require_contact.php';
    list($contact, $id, $user) = require_contact($mysqli, '../');

    $key = 'contacts/edit/values';
    if (!array_key_exists($key, $_SESSION)) {
        include_once __DIR__.'/../../../../fns/redirect.php';
        redirect("../?id=$id");
    }

    return [$user, $_SESSION[$key], $id];

}
