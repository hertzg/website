<?php

include_once '../../../fns/require_same_domain_referer.php';
require_same_domain_referer('..');

include_once '../fns/require_received_note.php';
include_once '../../../lib/mysqli.php';
list($receivedNote, $id, $user) = require_received_note($mysqli);
$id_users = $user->id_users;

$errors = [];

include_once '../../fns/request_note_params.php';
list($text, $tags, $tag_names) = request_note_params($errors);

include_once '../../../fns/redirect.php';

if ($errors) {
    $_SESSION['notes/received/edit-and-import/errors'] = $errors;
    $_SESSION['notes/received/edit-and-import/values'] = [
        'text' => $text,
        'tags' => $tags,
    ];
    redirect("./?id=$id");
}

unset(
    $_SESSION['notes/received/edit-and-import/errors'],
    $_SESSION['notes/received/edit-and-import/values']
);

include_once '../../../fns/Users/Notes/add.php';
Users\Notes\add($mysqli, $id_users, $text, $tags, $tag_names);

include_once '../../../fns/ReceivedNotes/delete.php';
ReceivedNotes\delete($mysqli, $id);

include_once '../../../fns/Users/Notes/Received/addNumber.php';
Users\Notes\Received\addNumber($mysqli, $id_users, -1);

$messages = ['Note has been imported.'];

if ($user->num_received_notes == 1) {
    $messages[] = 'No more received notes.';
    $_SESSION['notes/messages'] = $messages;
    unset($_SESSION['notes/errors']);
    redirect('../..');
}

$_SESSION['notes/received/messages'] = $messages;
redirect('..');
