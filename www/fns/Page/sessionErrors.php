<?php

namespace Page;

function sessionErrors ($key, $values = null) {
    if (array_key_exists($key, $_SESSION)) {
        $errors = $_SESSION[$key];
        if ($values !== null) {
            foreach ($errors as &$error) $error = $values[$error];
        }
        include_once __DIR__.'/errors.php';
        return errors($errors);
    }
}
