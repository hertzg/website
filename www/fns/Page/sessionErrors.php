<?php

namespace Page;

function sessionErrors ($key) {
    if (array_key_exists($key, $_SESSION)) {
        include_once __DIR__.'/errors.php';
        return errors($_SESSION[$key]);
    }
}
