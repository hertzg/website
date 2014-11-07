<?php

function check_admin_passwords ($username, $password1, $password2) {

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/Password/isShort.php";
    if (Password\isShort($password1)) {
        include_once "$fnsDir/Password/minLength.php";
        return 'Password too short. At least '
            .Password\minLength().' characters required.';
    }

    if ($password1 === $username) {
        return 'Please, choose a password'
            .' that is different from the username.';
    }

    if ($password1 !== $password2) return 'Passwords does\'t match.';

}
