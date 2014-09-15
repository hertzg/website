<?php

function get_main_engine () {
    $key = 'e552e415d7fdb1dcd15014a242340ff54f244d5ea6abb5fc4df84ab61f4d8e01';
    include_once __DIR__.'/../classes/Engine.php';
    return new Engine($key);
}
