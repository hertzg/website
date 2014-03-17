<?php

function check_passwords ($password1, $password2, array &$errors) {
    if ($password1 === '') {
        $errors[] = 'Enter password.';
    } else {
        include_once __DIR__.'/../../fns/Password/isShort.php';
        if (Password\isShort($password1)) {

            include_once __DIR__.'/../../fns/Password/minLength.php';
            $minLength = Password\minLength();

            $errors[] = "Password too short. At least $minLength characters required.";

        } elseif ($password1 != $password2) {
            $errors[] = 'Passwords does not match.';
        }
    }
}
