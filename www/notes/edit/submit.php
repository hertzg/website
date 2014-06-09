<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('..');

include_once '../fns/require_note.php';
include_once '../../lib/mysqli.php';
list($note, $id, $user) = require_note($mysqli);

$errors = [];

include_once '../fns/request_note_params.php';
list($text, $tags, $tag_names, $encrypt) = request_note_params($errors);

include_once '../../fns/ItemList/itemQuery.php';
$itemQuery = ItemList\itemQuery($id);

$_SESSION['notes/edit/values'] = [
    'text' => $text,
    'tags' => $tags,
    'encrypt' => $encrypt,
];

include_once '../../fns/redirect.php';

if ($errors) {
    $_SESSION['notes/edit/errors'] = $errors;
    redirect("./$itemQuery");
}

unset($_SESSION['notes/edit/errors']);

include_once '../../fns/request_strings.php';
list($sendButton) = request_strings('sendButton');
if ($sendButton) redirect("send/?id=$id");

unset($_SESSION['notes/edit/values']);

include_once '../../fns/Users/Notes/edit.php';
Users\Notes\edit($mysqli, $user->id_users, $id,
    $text, $tags, $tag_names, $encrypt);

$_SESSION['notes/view/messages'] = ['Changes have been saved.'];
redirect("../view/$itemQuery");
