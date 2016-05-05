<?php

function check_reset_passwords ($username, $password,
    $repeatPassword, &$errors, &$focus, $check_password = null) {

    if ($password === '') {
        $errors[] = 'Enter new password.';
        $focus = 'password';
        return;
    }

    include_once __DIR__.'/Password/isShort.php';
    if (Password\isShort($password)) {

        include_once __DIR__.'/Password/minLength.php';
        $minLength = Password\minLength();

        $errors[] = 'New password should be'
            ." at least $minLength characters long.";
        $focus = 'password';
        return;

    }

    if ($password === $username) {
        $errors[] = 'Please, choose a password'
            .' that is different from the username.';
        $focus = 'password';
        return;
    }

    if ($check_password !== null) {
        $check_password($errors, $focus);
        if ($errors) return;
    }

    if ($password !== $repeatPassword) {
        $errors[] = 'New passwords does not match.';
        $focus = 'repeatPassword';
    }

}
