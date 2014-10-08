<?php

$fnsDir = '../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('./');

include_once 'fns/require_received_note.php';
include_once '../../lib/mysqli.php';
list($receivedNote, $id, $user) = require_received_note($mysqli);

include_once "$fnsDir/Users/Notes/Received/import.php";
Users\Notes\Received\import($mysqli, $receivedNote);

$messages = ['Note has been imported.'];
include_once "$fnsDir/redirect.php";

if ($user->num_received_notes == 1) {
    $messages[] = 'No more received notes.';
    $_SESSION['notes/messages'] = $messages;
    unset($_SESSION['notes/errors']);
    redirect('..');
}

$_SESSION['notes/received/messages'] = $messages;

include_once "$fnsDir/ItemList/Received/listUrl.php";
redirect(ItemList\Received\listUrl());
