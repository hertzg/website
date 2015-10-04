<?php

function check_passwords ($username, $password, $repeatPassword, &$errors) {

    if ($password === '') {
        $errors[] = 'Enter password.';
        return;
    }

    include_once __DIR__.'/Password/isShort.php';
    if (Password\isShort($password)) {
        include_once __DIR__.'/Password/minLength.php';
        $minLength = Password\minLength();
        $errors[] = 'Password too short.'
            ." At least $minLength characters required.";
        return;
    }

    if ($password === $username) {
        $errors[] = 'Please, choose a password'
            .' that is different from the username.';
        return;
    }

    if ($password !== $repeatPassword) $errors[] = 'Passwords does not match.';

}
