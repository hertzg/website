<?php

namespace Users;

function getByVerifyEmailKey ($mysqli, $verify_email_key) {

    $verify_email_key = $mysqli->real_escape_string($verify_email_key);
    $sql = "select * from users where verify_email_key = '$verify_email_key'";
    include_once __DIR__.'/../mysqli_single_object.php';
    $user = mysqli_single_object($mysqli, $sql);

    if (!$user) return;

    include_once __DIR__.'/isVerifyEmailPending.php';
    if (isVerifyEmailPending($user)) return $user;

}
