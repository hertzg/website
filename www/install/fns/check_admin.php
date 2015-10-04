<?php

function check_admin ($username, $password, $repeatPassword, &$focus) {

    include_once __DIR__.'/check_admin_username.php';
    $error = check_admin_username($username);

    if ($error) {
        $focus = 'username';
        return $error;
    }

    include_once __DIR__.'/check_admin_passwords.php';
    return check_admin_passwords($username,
        $password, $repeatPassword, $focus);

}
