<?php

namespace Users;

function getByResetPasswordKey ($mysqli, $reset_password_key) {

    $reset_password_key = $mysqli->real_escape_string($reset_password_key);
    $sql = 'select * from users'
        ." where reset_password_key = '$reset_password_key'";
    include_once __DIR__.'/../mysqli_single_object.php';
    $user = mysqli_single_object($mysqli, $sql);

    if (!$user || $user->reset_password_key !== $reset_password_key ||
        $user->reset_password_key_time <= time() - 24 * 60 * 60) return;

    return $user;

}
