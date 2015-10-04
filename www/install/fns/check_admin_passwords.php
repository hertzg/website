<?php

function check_admin_passwords ($username,
    $password, $repeatPassword, &$focus) {

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/Password/isShort.php";
    if (Password\isShort($password)) {
        $focus = 'password';
        include_once "$fnsDir/Password/minLength.php";
        return 'Password too short. At least '
            .Password\minLength().' characters required.';
    }

    if ($password === $username) {
        $focus = 'password';
        return 'Please, choose a password'
            .' that is different from the username.';
    }

    if ($password !== $repeatPassword) {
        $focus = 'repeatPassword';
        return 'Passwords does\'t match.';
    }

}
