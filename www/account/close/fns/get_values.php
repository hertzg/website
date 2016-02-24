<?php

function get_values () {
    $key = 'account/close/values';
    if (array_key_exists($key, $_SESSION)) return $_SESSION[$key];
    return ['password' => ''];
}
