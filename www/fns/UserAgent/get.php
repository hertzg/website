<?php

namespace UserAgent;

function get () {
    $key = 'HTTP_USER_AGENT';
    if (array_key_exists($key, $_SERVER)) return $_SERVER[$key];
}
