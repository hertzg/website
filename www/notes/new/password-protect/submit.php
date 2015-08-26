<?php

$fnsDir = '../../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('./');

include_once 'fns/require_stage.php';
list($user, $stageValues) = require_stage();

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
    $_SESSION['notes/new/password-protect/errors'] = $errors;
    $_SESSION['notes/new/password-protect/values'] = ['password' => $password];
    include_once "$fnsDir/ItemList/pageQuery.php";
    redirect('./'.ItemList\pageQuery());
}

unset(
    $_SESSION['notes/new/password-protect/errors'],
    $_SESSION['notes/new/password-protect/values'],
    $_SESSION['notes/new/errors'],
    $_SESSION['notes/new/values']
);

$tags = $stageValues['tags'];

include_once "$fnsDir/Tags/parse.php";
$tag_names = Tags\parse($tags);

include_once "$fnsDir/Users/Notes/add.php";
include_once '../../../lib/mysqli.php';
$id = Users\Notes\add($mysqli, $user->id_users, $stageValues['text'],
    $tags, $tag_names, $stageValues['encrypt_in_listings'], true);

include_once "$fnsDir/ItemList/itemQuery.php";
redirect('../../view/'.ItemList\itemQuery($id));
