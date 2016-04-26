<?php

include_once '../../../../lib/defaults.php';

$fnsDir = '../../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('../..');

include_once 'fns/require_stage.php';
include_once '../../../lib/mysqli.php';
list($user, $stageValues, $id, $note) = require_stage($mysqli);

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
    $_SESSION['notes/edit/lock/errors'] = $errors;
    $_SESSION['notes/edit/lock/values'] = ['password' => $password];
    redirect("./$itemQuery");
}

unset(
    $_SESSION['notes/edit/errors'],
    $_SESSION['notes/edit/lock/errors'],
    $_SESSION['notes/edit/lock/values'],
    $_SESSION['notes/edit/values']
);

$tags = $stageValues['tags'];

include_once "$fnsDir/Tags/parse.php";
$tag_names = Tags\parse($tags);

include_once "$fnsDir/Crypto/decrypt.php";
$encryption_key = Crypto\decrypt($password,
    $user->encryption_key, $user->encryption_key_iv);

include_once "$fnsDir/Session/EncryptionKey/set.php";
Session\EncryptionKey\set($encryption_key);

include_once "$fnsDir/Users/Notes/edit.php";
Users\Notes\edit($mysqli, $note, $stageValues['text'],
    $tags, $tag_names, $stageValues['encrypt_in_listings'],
    true, $encryption_key, $changed);

if ($changed) $message = 'Changes have been saved.';
else $message = 'No changes to be saved.';
$_SESSION['notes/view/messages'] = [$message];

redirect("../../view/$itemQuery");
