<?php

namespace Users;

function getByResetPasswordKey ($mysqli, $id_users, $reset_password_key) {

    include_once __DIR__.'/get.php';
    $user = get($mysqli, $id_users);

    if (!$user || $user->reset_password_key !== hex2bin($reset_password_key) ||
        $user->reset_password_key_time <= time() - 24 * 60 * 60) return;

    return $user;

}
