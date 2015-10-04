<?php

function check_reset_passwords ($username,
    $password, $repeatPassword, &$errors) {

    if ($password === '') {
        $errors[] = 'Enter new password.';
        return;
    }

    include_once __DIR__.'/Password/isShort.php';
    if (Password\isShort($password)) {

        include_once __DIR__.'/Password/minLength.php';
        $minLength = Password\minLength();

        $errors[] = 'New password should be'
            ." at least $minLength characters long.";
        return;

    }

    if ($password === $username) {
        $errors[] = 'Please, choose a password'
            .' that is different from the username.';
        return;
    }

    if ($password !== $repeatPassword) {
        $errors[] = 'New passwords does not match.';
    }

}
