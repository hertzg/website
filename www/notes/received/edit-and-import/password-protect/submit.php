<?php

include_once '../../../../../lib/defaults.php';

$fnsDir = '../../../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('../..');

include_once 'fns/require_stage.php';
include_once '../../../../lib/mysqli.php';
list($user, $stageValues, $id, $receivedNote) = require_stage($mysqli);

include_once "$fnsDir/request_strings.php";
list($password) = request_strings('password');

$errors = [];

if ($password === '') $errors[] = 'Enter password.';
else {

    include_once "$fnsDir/Password/match.php";
    $match = Password\match($user->password_hash,
        $user->password_salt, $user->password_sha512_hash,
        $user->password_sha512_key, $password);

    if (!$match) $errors[] = 'Invalid password.';

}

include_once "$fnsDir/redirect.php";

if ($errors) {
    $_SESSION['notes/received/edit-and-import/password-protect/errors'] = $errors;
    $_SESSION['notes/received/edit-and-import/password-protect/values'] = [
        'password' => $password,
    ];
    include_once "$fnsDir/ItemList/Received/itemQuery.php";
    redirect('./'.ItemList\Received\itemQuery($id));
}

unset(
    $_SESSION['notes/received/edit-and-import/password-protect/errors'],
    $_SESSION['notes/received/edit-and-import/password-protect/values'],
    $_SESSION['notes/received/edit-and-import/errors'],
    $_SESSION['notes/received/edit-and-import/values']
);

$receivedNote->text = $stageValues['text'];
$receivedNote->tags = $stageValues['tags'];
$receivedNote->encrypt_in_listings = $stageValues['encrypt_in_listings'];

include_once "$fnsDir/Crypto/decrypt.php";
$encryption_key = Crypto\decrypt($password,
    $user->encryption_key, $user->encryption_key_iv);

include_once "$fnsDir/Session/EncryptionKey/set.php";
Session\EncryptionKey\set($encryption_key);

include_once "$fnsDir/Users/Notes/Received/import.php";
Users\Notes\Received\import($mysqli, $receivedNote, true, $encryption_key);

$messages = ['Note has been imported.'];

if ($user->num_received_notes == 1) {
    $messages[] = 'No more received notes.';
    $_SESSION['notes/messages'] = $messages;
    unset($_SESSION['notes/errors']);
    redirect('../../..');
}

unset($_SESSION['notes/received/errors']);
$_SESSION['notes/received/messages'] = $messages;

include_once "$fnsDir/ItemList/Received/listUrl.php";
redirect(ItemList\Received\listUrl('../../'));
