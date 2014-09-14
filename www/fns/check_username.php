<?php

function check_username ($mysqli, $username, &$errors, $exclude_id = 0) {

    if ($username === '') {
        $errors[] = 'Enter username.';
        return;
    }

    include_once __DIR__.'/Username/isShort.php';
    if (Username\isShort($username)) {
        include_once __DIR__.'/Username/minLength.php';
        $minLength = Username\minLength();
        $errors[] = 'Username too short.'
            ." At least $minLength characters required.";
        return;
    }

    include_once __DIR__.'/Username/isLong.php';
    if (Username\isLong($username)) {
        include_once __DIR__.'/Username/maxLength.php';
        $maxLength = Username\maxLength();
        $errors[] = "Username too long. Maximum $maxLength characters allowed.";
        return;
    }

    include_once __DIR__.'/Username/containsIllegalChars.php';
    if (Username\containsIllegalChars($username)) {
        $errors[] = 'The username contains illegal characters.';
        return;
    }

    include_once __DIR__.'/Users/getByUsername.php';
    if (Users\getByUsername($mysqli, $username, $exclude_id)) {
        $errors[] = 'The username is unavailable. Try another.';
    }

}
