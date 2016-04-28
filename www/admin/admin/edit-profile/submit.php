<?php

include_once '../../../../lib/defaults.php';

$fnsDir = '../../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('./');

include_once '../../fns/require_admin.php';
require_admin();

include_once "$fnsDir/Username/request.php";
$username = Username\request();

$errors = [];

if ($username === '') {
    $errors[] = 'Enter username.';
    $focus = 'username';
} else {
    include_once "$fnsDir/Username/isShort.php";
    if (Username\isShort($username)) {
        include_once "$fnsDir/Username/minLength.php";
        $errors[] = 'Username too short. At least '
            .Username\minLength().' characters required.';
        $focus = 'username';
    } else {
        include_once "$fnsDir/Username/containsIllegalChars.php";
        if (Username\containsIllegalChars($username)) {
            $errors[] = 'The username contains illegal characters.';
            $focus = 'username';
        } else {
            include_once "$fnsDir/Username/containsOnlyDigits.php";
            if (Username\containsOnlyDigits($username)) {
                $errors[] = 'Username should contain at least'
                    .' one alphabetic character.';
                $focus = 'username';
            }
        }
    }
}

if (!$errors) {

    include_once "$fnsDir/Admin/get.php";
    Admin\get($current_username, $hash, $salt, $sha512_hash, $sha512_key);

    if ($current_username === $username) $changed = false;
    else {

        include_once "$fnsDir/Admin/set.php";
        $ok = Admin\set($username, $sha512_hash, $sha512_key);

        if ($ok === false) {
            $errors[] = 'Failed to save the data.';
            $focus = 'button';
        } else {
            $changed = true;
        }

    }

}

include_once "$fnsDir/redirect.php";

if ($errors) {
    $_SESSION['admin/admin/edit-profile/errors'] = $errors;
    $_SESSION['admin/admin/edit-profile/values'] = [
        'focus' => $focus,
        'username' => $username,
    ];
    redirect();
}

unset(
    $_SESSION['admin/admin/edit-profile/errors'],
    $_SESSION['admin/admin/edit-profile/values']
);

if ($changed) $message = 'Changes have been saved.';
else $message = 'No changes to be saved.';
$_SESSION['admin/admin/messages'] = [$message];

redirect('..');
