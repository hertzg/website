<?php

include_once '../../../fns/require_same_domain_referer.php';
require_same_domain_referer('..');

include_once '../fns/require_received_note.php';
include_once '../../../lib/mysqli.php';
list($receivedNote, $id, $user) = require_received_note($mysqli);
$id_users = $user->id_users;

$text = $receivedNote->text;
$tags = $receivedNote->tags;

include_once '../../../fns/Tags/parse.php';
$tag_names = Tags\parse($tags);

include_once '../../../fns/Notes/add.php';
$id_notes = Notes\add($mysqli, $id_users, $text, $tags);

include_once '../../../fns/NoteTags/add.php';
NoteTags\add($mysqli, $id_users, $id_notes, $tag_names, $text);

include_once '../../../fns/Users/addNumNotes.php';
Users\addNumNotes($mysqli, $id_users, 1);

include_once '../../../fns/ReceivedNotes/delete.php';
ReceivedNotes\delete($mysqli, $id);

include_once '../../../fns/Users/addNumReceivedNotes.php';
Users\addNumReceivedNotes($mysqli, $id_users, -1);

$messages = ['Note has been imported.'];
include_once '../../../fns/redirect.php';

if ($user->num_received_notes == 1) {
    $messages[] = 'No more received notes.';
    $_SESSION['notes/messages'] = $messages;
    unset($_SESSION['notes/errors']);
    redirect('../..');
}

$_SESSION['notes/received/messages'] = $messages;

redirect('..');
