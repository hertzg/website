<?php

include_once __DIR__.'/../fns/ifset.php';

class Captcha {

    static function reset () {
        unset(
            $_SESSION['captcha'],
            $_SESSION['captcha_left']
        );
    }

    static function check (&$errors, $valid = 0) {
        $captcha = isset($_POST['captcha']) ? $_POST['captcha'] : '';
        if (self::required()) {
            if (!$captcha) {
                $errors[] = 'Enter verification.';
            } elseif ($captcha == ifset($_SESSION['captcha'])) {
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
        return !isset($_SESSION['captcha_left']);
    }

}
