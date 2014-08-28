<?php

function require_stage ($mysqli) {

    include_once __DIR__.'/../../../fns/require_contact.php';
    list($contact, $id, $user) = require_contact($mysqli, '../');

    $key = 'contacts/edit/values';
    if (!array_key_exists($key, $_SESSION)) {
        $fnsDir = __DIR__.'/../../../../fns';
        include_once "$fnsDir/redirect.php";
        include_once "$fnsDir/ItemList/itemQuery.php";
        redirect('../'.ItemList\itemQuery($id));
    }

    return [$user, $_SESSION[$key], $id];

}
