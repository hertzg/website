<?php

include_once '../../../lib/defaults.php';

$fnsDir = '../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('..');

include_once '../fns/require_note.php';
include_once '../../lib/mysqli.php';
list($note, $id, $user) = require_note($mysqli);

include_once '../fns/request_note_params.php';
list($text, $tags, $tag_names, $encrypt_in_listings,
    $password_protect) = request_note_params($errors, $focus);

include_once "$fnsDir/ItemList/itemQuery.php";
$itemQuery = ItemList\itemQuery($id);

$values = [
    'focus' => $focus,
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

include_once "$fnsDir/Session/EncryptionKey/get.php";
$encryption_key = Session\EncryptionKey\get();

if ($password_protect && $encryption_key === null) {
    $_SESSION['notes/edit/password-protect/note'] = $values;
    unset(
        $_SESSION['notes/edit/password-protect/errors'],
        $_SESSION['notes/edit/password-protect/values']
    );
    redirect("password-protect/$itemQuery");
}

unset($_SESSION['notes/edit/values']);

include_once "$fnsDir/Users/Notes/edit.php";
Users\Notes\edit($mysqli, $note, $text, $tags, $tag_names,
    $encrypt_in_listings, $password_protect, $encryption_key, $changed);

if ($changed) $message = 'Changes have been saved.';
else $message = 'No changes to be saved.';
$_SESSION['notes/view/messages'] = [$message];

redirect("../view/$itemQuery");
