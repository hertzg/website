<?php

include_once '../../../../lib/defaults.php';

$fnsDir = '../../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('..');

include_once '../fns/require_received_note.php';
include_once '../../../lib/mysqli.php';
list($receivedNote, $id, $user) = require_received_note($mysqli, '../');

include_once '../../fns/request_note_params.php';
list($text, $tags, $tag_names, $encrypt_in_listings,
    $password_protect) = request_note_params($errors, $focus);

$values = [
    'focus' => $focus,
    'text' => $text,
    'tags' => $tags,
    'encrypt_in_listings' => $encrypt_in_listings,
    'password_protect' => $password_protect,
];

$_SESSION['notes/received/edit-and-import/values'] = $values;

include_once "$fnsDir/redirect.php";

if ($errors) {
    $_SESSION['notes/received/edit-and-import/errors'] = $errors;
    include_once "$fnsDir/ItemList/Received/itemQuery.php";
    redirect('./'.ItemList\Received\itemQuery($id));
}

unset($_SESSION['notes/received/edit-and-import/errors']);

include_once "$fnsDir/Session/EncryptionKey/get.php";
$encryption_key = Session\EncryptionKey\get();

if ($password_protect && $encryption_key === null) {
    $_SESSION['notes/received/edit-and-import/password-protect/note'] = $values;
    unset(
        $_SESSION['notes/received/edit-and-import/password-protect/errors'],
        $_SESSION['notes/received/edit-and-import/password-protect/values']
    );
    include_once "$fnsDir/ItemList/Received/itemQuery.php";
    redirect('password-protect/'.ItemList\Received\itemQuery($id));
}

unset($_SESSION['notes/received/edit-and-import/values']);

$receivedNote->text = $text;
$receivedNote->tags = $tags;
$receivedNote->encrypt_in_listings = $encrypt_in_listings;

include_once "$fnsDir/Users/Notes/Received/import.php";
Users\Notes\Received\import($mysqli,
    $receivedNote, $password_protect, $encryption_key);

$messages = ['Note has been imported.'];

if ($user->num_received_notes == 1) {
    $messages[] = 'No more received notes.';
    $_SESSION['notes/messages'] = $messages;
    unset($_SESSION['notes/errors']);
    redirect('../..');
}

unset($_SESSION['notes/received/errors']);
$_SESSION['notes/received/messages'] = $messages;

include_once "$fnsDir/ItemList/Received/listUrl.php";
redirect(ItemList\Received\listUrl('../'));
