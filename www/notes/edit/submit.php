<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('..');

include_once '../fns/require_note.php';
include_once '../../lib/mysqli.php';
list($note, $id, $user) = require_note($mysqli);
$id_users = $user->id_users;

$errors = [];

include_once '../fns/request_note_params.php';
list($text, $tags, $tag_names) = request_note_params($errors);

include_once '../../fns/ItemList/itemQuery.php';
$itemQuery = ItemList\itemQuery($id);

include_once '../../fns/redirect.php';

if ($errors) {
    $_SESSION['notes/edit/errors'] = $errors;
    $_SESSION['notes/edit/values'] = [
        'text' => $text,
        'tags' => $tags,
    ];
    redirect("./$itemQuery");
}

unset(
    $_SESSION['notes/edit/errors'],
    $_SESSION['notes/edit/values']
);

include_once '../../fns/Notes/edit.php';
Notes\edit($mysqli, $id_users, $id, $text, $tags);

include_once '../../fns/NoteTags/deleteOnNote.php';
NoteTags\deleteOnNote($mysqli, $id);

include_once '../../fns/NoteTags/add.php';
NoteTags\add($mysqli, $id_users, $id, $tag_names, $text);

$_SESSION['notes/view/messages'] = ['Changes have been saved.'];
redirect("../view/$itemQuery");
