<?php

namespace Users;

function getByVerifyEmailKey ($mysqli, $id_users, $verify_email_key) {

    include_once __DIR__.'/get.php';
    $user = get($mysqli, $id_users);

    if (!$user || $user->verify_email_key !== hex2bin($verify_email_key) ||
        $user->verify_email_key_time <= time() - 24 * 60 * 60) return;

    return $user;

}
