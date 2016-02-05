<?php

namespace Form;

function password ($name, $text, $options = []) {
    $options['type'] = 'password';
    include_once __DIR__.'/textfield.php';
    return textfield($name, $text, $options);
}
