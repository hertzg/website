<?php

function check_passwords ($username, $password1, $password2, &$errors) {

    if ($password1 === '') {
        $errors[] = 'Enter password.';
        return;
    }

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/Password/isShort.php";
    if (Password\isShort($password1)) {
        include_once "$fnsDir/Password/minLength.php";
        $minLength = Password\minLength();
        $errors[] = 'Password too short.'
            ." At least $minLength characters required.";
        return;
    }

    if ($password1 === $username) {
        $errors[] = 'Please, choose a password'
            .' that is different from the username.';
        return;
    }

    if ($password1 !== $password2) $errors[] = 'Passwords does not match.';

}
