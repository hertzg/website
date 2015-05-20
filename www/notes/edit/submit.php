<?php

$fnsDir = '../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('..');

include_once '../fns/require_note.php';
include_once '../../lib/mysqli.php';
list($note, $id, $user) = require_note($mysqli);

include_once '../fns/request_note_params.php';
list($text, $tags, $tag_names, $encrypt) = request_note_params($errors);

include_once "$fnsDir/ItemList/itemQuery.php";
$itemQuery = ItemList\itemQuery($id);

$values = [
    'text' => $text,
    'tags' => $tags,
    'encrypt' => $encrypt,
];

$_SESSION['notes/edit/values'] = $values;

include_once "$fnsDir/redirect.php";

if ($errors) {
    $_SESSION['notes/edit/errors'] = $errors;
    redirect("./$itemQuery");
}

unset($_SESSION['notes/edit/errors']);

include_once "$fnsDir/request_strings.php";
list($sendButton) = request_strings('sendButton');
if ($sendButton) {
    unset(
        $_SESSION['notes/edit/send/errors'],
        $_SESSION['notes/edit/send/messages'],
        $_SESSION['notes/edit/send/values']
    );
    $_SESSION['notes/edit/send/note'] = $values;
    redirect("send/$itemQuery");
}

unset($_SESSION['notes/edit/values']);

include_once "$fnsDir/Users/Notes/edit.php";
Users\Notes\edit($mysqli, $note, $text, $tags, $tag_names, $encrypt);

$_SESSION['notes/view/messages'] = ['Changes have been saved.'];
redirect("../view/$itemQuery");
