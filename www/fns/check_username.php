<?php

function check_username ($mysqli,
    $username, &$errors, &$focus, $exclude_id = 0) {

    if ($username === '') {
        $errors[] = 'Enter username.';
        if ($focus === null) $focus = 'username';
        return;
    }

    include_once __DIR__.'/Username/isShort.php';
    if (Username\isShort($username)) {
        include_once __DIR__.'/Username/minLength.php';
        $minLength = Username\minLength();
        $errors[] = 'Username too short.'
            ." At least $minLength characters required.";
        if ($focus === null) $focus = 'username';
        return;
    }

    include_once __DIR__.'/Username/containsIllegalChars.php';
    if (Username\containsIllegalChars($username)) {
        $errors[] = 'The username contains illegal characters.';
        if ($focus === null) $focus = 'username';
        return;
    }

    include_once __DIR__.'/Username/containsOnlyDigits.php';
    if (Username\containsOnlyDigits($username)) {
        $errors[] = 'Username should contain at least'
            .' one alphabetic character.';
        if ($focus === null) $focus = 'username';
        return;
    }

    include_once __DIR__.'/Users/getByUsername.php';
    if (Users\getByUsername($mysqli, $username, $exclude_id)) {
        $errors[] = 'The username is unavailable. Try another.';
        if ($focus === null) $focus = 'username';
    }

}
