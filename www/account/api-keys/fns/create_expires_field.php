<?php

function create_expires_field ($value) {

    $options = [];

    if ($value !== '' && $value != 7 && $value != 30 && $value != 360) {
        if ($value == 1) $text = 'today';
        elseif ($value == 2) $text = 'tomorrow';
        else $text = "in $value days";
        $options[$value] = $text;
    }

    $options[''] = 'never';
    $options[7] = 'in 7 days';
    $options[30] = 'in 30 days';
    $options[360] = 'in 360 days';

    include_once __DIR__.'/../../../fns/Form/select.php';
    return Form\select('expires', 'Expires', $options, $value);

}
