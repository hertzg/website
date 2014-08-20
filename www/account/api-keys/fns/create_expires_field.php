<?php

function create_expires_field ($value) {
    include_once __DIR__.'/../../../fns/Form/select.php';
    return Form\select('expires', 'Expires', [
        '' => 'never',
        '7' => 'in 7 days',
        '30' => 'in 30 days',
        '360' => 'in 360 days',
    ], $value);
}
