<?php

namespace Password;

function match ($hash, $password) {
    return $hash == md5($password, true);
}
