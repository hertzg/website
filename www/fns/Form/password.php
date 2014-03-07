<?php

namespace Form;

function password ($name, $text, array $config = array()) {
    $config['type'] = 'password';
    include_once __DIR__.'/../../classes/Form.php';
    return \Form::textfield($name, $text, $config);
}
