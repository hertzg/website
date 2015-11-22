<?php

function check_username ($username, &$errors, &$focus) {

    if ($username === '') {
        $errors[] = 'Enter new username.';
        $focus = 'username';
        return;
    }

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/Username/isShort.php";
    if (Username\isShort($username)) {
        include_once "$fnsDir/Username/minLength.php";
        $errors[] = 'New username too short. At least '
            .Username\minLength().' characters required.';
        $focus = 'username';
        return;
    }

    include_once "$fnsDir/Username/containsIllegalChars.php";
    if (Username\containsIllegalChars($username)) {
        $errors[] = 'The new username contains illegal characters.';
        $focus = 'username';
        return;
    }

    include_once "$fnsDir/Username/containsOnlyDigits.php";
    if (Username\containsOnlyDigits($username)) {
        $errors[] = 'New username should contain at least'
            .' one alphabetic character.';
        $focus = 'username';
    }

}
