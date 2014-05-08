<?php

include_once '../../../fns/require_same_domain_referer.php';
require_same_domain_referer('..');

include_once '../fns/require_received_note.php';
include_once '../../../lib/mysqli.php';
list($receivedNote, $id, $user) = require_received_note($mysqli);

$text = $receivedNote->text;
$tags = $receivedNote->tags;

include_once '../../../fns/Tags/parse.php';
$tag_names = Tags\parse($tags);

include_once '../../../fns/Users/Notes/add.php';
Users\Notes\add($mysqli, $user->id_users, $text, $tags, $tag_names);

include_once '../../../fns/Users/Notes/Received/delete.php';
Users\Notes\Received\delete($mysqli, $receivedNote);

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
