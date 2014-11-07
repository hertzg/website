<?php

function check_admin ($username, $password1, $password2) {

    include_once __DIR__.'/check_admin_username.php';
    $error = check_admin_username($username);

    if ($error === null) {
        include_once __DIR__.'/check_admin_passwords.php';
        $error = check_admin_passwords($username, $password1, $password2);
    }

    return $error;

}
