<?php

function get_main_engine () {
    $key = 'a5ea67f1c98f9c57af3fbc2996a27f30669e6747ca46f39bf27d50dcda7dc9f9';
    include_once __DIR__.'/../classes/Engine.php';
    return new Engine($key);
}
