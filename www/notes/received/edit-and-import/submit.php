<?php

include_once '../fns/require_received_note.php';
include_once '../../../lib/mysqli.php';
list($receivedNote, $id, $user) = require_received_note($mysqli);
$id_users = $user->id_users;

include_once '../../../fns/request_strings.php';
list($text, $tags) = request_strings('text', 'tags');

include_once '../../../fns/str_collapse_spaces_multiline.php';
$text = str_collapse_spaces_multiline($text);

include_once '../../../fns/str_collapse_spaces.php';
$tags = str_collapse_spaces($tags);

$errors = [];

if ($text === '') $errors[] = 'Enter URL.';

include_once '../../../fns/parse_tags.php';
parse_tags($tags, $tag_names, $errors);

include_once '../../../fns/redirect.php';

if ($errors) {
    $_SESSION['notes/received/edit-and-import/errors'] = $errors;
    $_SESSION['notes/received/edit-and-import/values'] = [
        'text' => $text,
        'tags' => $tags,
    ];
    redirect("./?id=$id");
}

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

if ($user->num_received_notes == 1) {
    $messages[] = 'No more received notes.';
    $_SESSION['notes/messages'] = $messages;
    unset($_SESSION['notes/errors']);
    redirect('../..');
}

$_SESSION['notes/received/messages'] = $messages;
redirect('..');
