<?php

namespace Captcha;

function reset () {
    unset($_SESSION['captcha'], $_SESSION['captcha_left']);
}
