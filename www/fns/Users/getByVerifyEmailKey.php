<?php

namespace Users;

function getByVerifyEmailKey ($mysqli, $id_users, $verify_email_key) {

    include_once __DIR__.'/get.php';
    $user = get($mysqli, $id_users);

    if (!$user) return;

    include_once __DIR__.'/isVerifyEmailPending.php';
    if (!isVerifyEmailPending($user)) return;

    if ($user->verify_email_key !== hex2bin($verify_email_key)) return;

    return $user;

}
