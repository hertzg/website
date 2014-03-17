<?php

function check_username ($mysqli, $username, array &$errors) {
    if ($username === '') {
        $errors[] = 'Enter username.';
    } elseif (mb_strlen($username, 'UTF-8') < 6) {
        $errors[] = 'Username too short. At least 6 characters required.';
    } else {
        include_once __DIR__.'/../../fns/Users/getByUsername.php';
        if (Users\getByUsername($mysqli, $username)) {
            $errors[] = 'The username is unavailable. Try another.';
        }
    }
}
