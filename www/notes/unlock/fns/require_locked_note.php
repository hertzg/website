<?php

function require_locked_note ($mysqli) {

    include_once __DIR__.'/../../fns/require_note.php';
    list($note, $id, $user) = require_note($mysqli);

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/Session/EncryptionKey/get.php";
    $encryption_key = Session\EncryptionKey\get();

    if ($encryption_key !== null) {
        include_once "$fnsDir/redirect.php";
        include_once "$fnsDir/ItemList/itemQuery.php";
        $message = 'Password-protected notes are already unlocked.';
        $_SESSION['notes/view/messages'] = [$message];
        redirect('../view/'.ItemList\itemQuery($id));
    }

    return [$note, $id, $user];

}
