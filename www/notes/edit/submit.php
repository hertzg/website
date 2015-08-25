<?php

$fnsDir = '../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('..');

include_once '../fns/require_note.php';
include_once '../../lib/mysqli.php';
list($note, $id, $user) = require_note($mysqli);

include_once '../fns/request_note_params.php';
list($text, $tags, $tag_names, $encrypt_in_listings,
    $password_protect) = request_note_params($errors);

include_once "$fnsDir/ItemList/itemQuery.php";
$itemQuery = ItemList\itemQuery($id);

$values = [
    'text' => $text,
    'tags' => $tags,
    'encrypt_in_listings' => $encrypt_in_listings,
    'password_protect' => $password_protect,
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

if ($password_protect) {
    include_once "$fnsDir/Session/EncryptionKey/present.php";
    if (!Session\EncryptionKey\present()) {
        $_SESSION['notes/edit/encrypt/note'] = $values;
        unset(
            $_SESSION['notes/edit/encrypt/errors'],
            $_SESSION['notes/edit/encrypt/values']
        );
        redirect("encrypt/$itemQuery");
    }
}

unset($_SESSION['notes/edit/values']);

include_once "$fnsDir/Users/Notes/edit.php";
Users\Notes\edit($mysqli, $note, $text, $tags,
    $tag_names, $encrypt_in_listings, $password_protect);

$_SESSION['notes/view/messages'] = ['Changes have been saved.'];
redirect("../view/$itemQuery");
