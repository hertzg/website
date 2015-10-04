<?php

$fnsDir = '../../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('..');

include_once '../fns/require_user.php';
include_once '../../../lib/mysqli.php';
list($user, $id) = require_user($mysqli);

include_once "$fnsDir/request_strings.php";
list($username) = request_strings('username');

include_once '../../../lib/mysqli.php';

include_once "$fnsDir/check_username.php";
check_username($mysqli, $username, $errors, $id);

if (!$errors) {
    include_once "$fnsDir/Password/match.php";
    $match = Password\match($user->password_hash, $user->password_salt,
        $user->password_sha512_hash, $user->password_sha512_key, $username);
    if ($match) {
        $errors[] = 'Please, choose a username that'
            .' is different from the user\'s password.';
    }
}

include_once "$fnsDir/ItemList/itemQuery.php";
$itemQuery = ItemList\itemQuery($id);

include_once "$fnsDir/redirect.php";

if ($errors) {
    $_SESSION['admin/users/edit-profile/errors'] = $errors;
    $_SESSION['admin/users/edit-profile/values'] = ['username' => $username];
    redirect("./$itemQuery");
}

unset(
    $_SESSION['admin/users/edit-profile/errors'],
    $_SESSION['admin/users/edit-profile/values']
);

include_once "$fnsDir/Users/Account/editProfile.php";
Users\Account\editProfile($mysqli, $user, $username,
    $user->email, $user->full_name, $user->timezone);

$_SESSION['admin/users/view/messages'] = ['Changes have been saved.'];

redirect("../view/$itemQuery");
