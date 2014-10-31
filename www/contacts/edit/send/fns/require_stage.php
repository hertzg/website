<?php

function require_stage ($mysqli, $base = '') {

    include_once __DIR__.'/../../../fns/require_contact.php';
    list($contact, $id, $user) = require_contact($mysqli, "$base../");

    $key = 'contacts/edit/send/contact';
    if (!array_key_exists($key, $_SESSION)) {
        $fnsDir = __DIR__.'/../../../../fns';
        include_once "$fnsDir/redirect.php";
        include_once "$fnsDir/ItemList/itemQuery.php";
        redirect("$base../".ItemList\itemQuery($id));
    }

    return [$user, $_SESSION[$key], $id, $contact];

}
