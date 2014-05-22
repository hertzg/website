<?php

function get_main_engine () {
    $key = '62b724e98e3c19d19392c5a377aa5cb235071f4e19025284d75eba97fec35009';
    include_once __DIR__.'/../classes/Engine.php';
    return new Engine($key);
}
