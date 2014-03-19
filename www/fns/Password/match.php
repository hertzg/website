<?php

namespace Password;

function match ($hash, $salt, $password) {
    return $hash === md5($password.$salt, true);
}
