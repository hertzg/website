<?php

include_once '../../../lib/defaults.php';

$fnsDir = '../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('..');

include_once 'fns/require_locked_note.php';
include_once '../../lib/mysqli.php';
list($note, $id, $user) = require_locked_note($mysqli);

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

include_once "$fnsDir/ItemList/itemQuery.php";
$itemQuery = ItemList\itemQuery($id);

include_once "$fnsDir/redirect.php";

if ($errors) {
    $_SESSION['notes/unlock/errors'] = $errors;
    $_SESSION['notes/unlock/values'] = ['password' => $password];
    redirect("./$itemQuery");
}

unset(
    $_SESSION['notes/unlock/errors'],
    $_SESSION['notes/unlock/values']
);

include_once "$fnsDir/Crypto/decrypt.php";
$encryption_key = Crypto\decrypt($password,
    $user->encryption_key, $user->encryption_key_iv);

include_once "$fnsDir/Session/EncryptionKey/set.php";
Session\EncryptionKey\set($encryption_key);

$message = 'Password-protected notes have been unlocked.';
$_SESSION['notes/view/messages'] = [$message];

redirect("../view/$itemQuery");
