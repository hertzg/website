<?php

function check_email ($email, &$errors, &$focus) {

    if ($email === '') return;

    include_once __DIR__.'/Email/isValid.php';
    if (Email\isValid($email)) return;

    $errors[] = 'The email is invalid.';
    if ($focus === null) $focus = 'email';

}
