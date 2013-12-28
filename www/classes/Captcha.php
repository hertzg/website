<?php

class Captcha {

    static function reset () {
        unset(
            $_SESSION['captcha'],
            $_SESSION['captcha_left']
        );
    }

    static function check (&$errors, $valid = 0) {
        if (self::required()) {

            include_once __DIR__.'/../fns/request_strings.php';
            list($captcha) = request_strings('captcha');

            include_once __DIR__.'/../fns/str_collapse_spaces.php';
            $captcha = str_collapse_spaces($captcha);

            if ($captcha === '') {
                $errors[] = 'Enter verification.';
            } elseif (array_key_exists('captcha', $_SESSION) &&
                $captcha == $_SESSION['captcha']) {
                $_SESSION['captcha_left'] = $valid;
            } else {
                $errors[] = 'Invalid verification. Try again.';
            }

            unset($_SESSION['captcha']);

        } else {
            $_SESSION['captcha_left']--;
            if ($_SESSION['captcha_left'] <= 0) {
                unset($_SESSION['captcha_left']);
            }
        }
    }

    static function required () {
        return !array_key_exists('captcha_left', $_SESSION);
    }

}
