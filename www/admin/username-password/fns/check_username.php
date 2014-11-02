<?php

function check_username ($username, &$errors) {

    if ($username === '') {
        $errors[] = 'Enter new username.';
        return;
    }

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/Username/isShort.php";
    if (Username\isShort($username)) {
        include_once "$fnsDir/Username/minLength.php";
        $errors[] = 'New username too short. At least '
            .Username\minLength().' characters required.';
        return;
    }

    include_once "$fnsDir/Username/isLong.php";
    if (Username\isLong($username)) {
        include_once "$fnsDir/Username/maxLength.php";
        $errors[] = 'New username too long. Maximum '
            .Username\maxLength().' characters allowed.';
        return;
    }

    include_once "$fnsDir/Username/containsIllegalChars.php";
    if (Username\containsIllegalChars($username)) {
        $errors[] = 'The new username contains illegal characters.';
        return;
    }

    include_once "$fnsDir/Username/containsOnlyDigits.php";
    if (Username\containsOnlyDigits($username)) {
        $errors[] = 'New username should contain at least'
            .' one alphabetic character.';
    }

}
