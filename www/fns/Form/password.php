<?php

namespace Form;

function password ($name, $text, array $config = array()) {
    $config['type'] = 'password';
    include_once __DIR__.'/textfield.php';
    return textfield($name, $text, $config);
}
