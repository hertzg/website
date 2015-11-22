<?php

function check_admin_username ($username) {

    if ($username === '') return 'Enter username.';

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/Username/isShort.php";
    if (Username\isShort($username)) {
        include_once "$fnsDir/Username/minLength.php";
        return 'Username too short. At least '
            .Username\minLength().' characters required.';
    }

    include_once "$fnsDir/Username/containsIllegalChars.php";
    if (Username\containsIllegalChars($username)) {
        return 'The username contains illegal characters.';
    }

    include_once "$fnsDir/Username/containsOnlyDigits.php";
    if (Username\containsOnlyDigits($username)) {
        return 'Username should contain at least'
            .' one alphabetic character.';
    }

}
