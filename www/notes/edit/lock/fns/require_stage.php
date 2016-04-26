<?php

function require_stage ($mysqli) {

    include_once __DIR__.'/../../../fns/require_note.php';
    list($note, $id, $user) = require_note($mysqli, '../');

    $key = 'notes/edit/lock/note';
    if (!array_key_exists($key, $_SESSION)) {
        $fnsDir = __DIR__.'/../../../../fns';
        include_once "$fnsDir/redirect.php";
        include_once "$fnsDir/ItemList/itemQuery.php";
        redirect('../'.ItemList\itemQuery($id));
    }

    return [$user, $_SESSION[$key], $id, $note];

}
