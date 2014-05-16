<?php

namespace Files;

function request () {

    include_once __DIR__.'/../request_strings.php';
    list($name) = request_strings('name');

    include_once __DIR__.'/../str_collapse_spaces.php';
    $name = str_collapse_spaces($name);

    return $name;

}
