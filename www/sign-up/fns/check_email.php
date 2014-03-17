<?php

function check_email ($mysqli, $email, array &$errors) {
    if ($email === '') {
        $errors[] = 'Enter email.';
    } else {
        include_once __DIR__.'/../../fns/is_email_valid.php';
        if (!is_email_valid($email)) {
            $errors[] = 'Enter a valid email address.';
        } else {
            include_once __DIR__.'/../../fns/Users/getByEmail.php';
            if (Users\getByEmail($mysqli, $email)) {
                $errors[] =
                    'A username with this email is already registered.'
                    .' Try another.';
            }
        }
    }
}
