<?php

include_once '../../../fns/require_same_domain_referer.php';
require_same_domain_referer('../..');

include_once '../fns/require_received_note.php';
include_once '../../../lib/mysqli.php';
list($receivedNote, $id, $user) = require_received_note($mysqli, '../');

include_once '../../../fns/Users/Notes/Received/delete.php';
Users\Notes\Received\delete($mysqli, $receivedNote);

$messages = ['Note has been deleted.'];
include_once '../../../fns/redirect.php';

if ($user->num_received_notes == 1) {
    $messages[] = 'No more received notes.';
    $_SESSION['notes/messages'] = $messages;
    unset($_SESSION['notes/errors']);
    redirect('../..');
}

$_SESSION['notes/received/messages'] = $messages;
redirect('..');
