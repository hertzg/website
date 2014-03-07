<?php

namespace Captcha;

function required () {
    return !array_key_exists('captcha_left', $_SESSION);
}
