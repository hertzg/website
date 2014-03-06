<?php

namespace Page;

function sessionMessages ($key) {
    if (array_key_exists($key, $_SESSION)) {
        include_once __DIR__.'/messages.php';
        return messages($_SESSION[$key]);
    }
}
