<?php

namespace Form;

function password ($name, $text, array $config = []) {
    $config['type'] = 'password';
    include_once __DIR__.'/textfield.php';
    return textfield($name, $text, $config);
}
