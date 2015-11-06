<?php

namespace Captcha;

function check (&$errors, &$focus) {
    include_once __DIR__.'/required.php';
    if (required()) {

        include_once __DIR__.'/../request_strings.php';
        list($captcha) = request_strings('captcha');

        include_once __DIR__.'/../str_collapse_spaces.php';
        $captcha = str_collapse_spaces($captcha);

        if ($captcha === '') {
            $errors[] = 'Please, enter verification.';
            if ($focus === null) $focus = 'captcha';
        } elseif (array_key_exists('captcha', $_SESSION) &&
            $captcha == $_SESSION['captcha']) {

            $_SESSION['captcha_left'] = 3;

        } else {
            $errors[] = 'Invalid verification. Try again.';
            if ($focus === null) $focus = 'captcha';
        }

        unset($_SESSION['captcha']);

    } else {
        $_SESSION['captcha_left']--;
        if ($_SESSION['captcha_left'] <= 0) unset($_SESSION['captcha_left']);
    }
}
