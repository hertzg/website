<?php

function require_stage ($mysqli) {

    include_once __DIR__.'/../../../fns/require_received_note.php';
    list($receivedNote, $id, $user) = require_received_note($mysqli, '../../');

    $key = 'notes/received/edit-and-import/lock/note';
    if (!array_key_exists($key, $_SESSION)) {
        $fnsDir = __DIR__.'/../../../../fns';
        include_once "$fnsDir/redirect.php";
        include_once "$fnsDir/ItemList/Received/itemQuery.php";
        redirect('../'.ItemList\Received\itemQuery($id));
    }

    return [$user, $_SESSION[$key], $id, $receivedNote];

}
