<?php

$fnsDir = '../../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('../..');

include_once '../fns/require_received_note.php';
include_once '../../../lib/mysqli.php';
list($receivedNote, $id, $user) = require_received_note($mysqli, '../');

include_once "$fnsDir/Users/Notes/Received/delete.php";
Users\Notes\Received\delete($mysqli, $receivedNote);

$messages = ["Received note #$id has been deleted."];
include_once "$fnsDir/redirect.php";

if ($user->num_received_notes == 1) {
    $messages[] = 'No more received notes.';
    $_SESSION['notes/messages'] = $messages;
    unset($_SESSION['notes/errors']);
    redirect('../..');
}

unset($_SESSION['notes/received/errors']);
$_SESSION['notes/received/messages'] = $messages;

include_once "$fnsDir/ItemList/Received/listUrl.php";
redirect(ItemList\Received\listUrl('../'));
