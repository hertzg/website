<?php

function create_expires_field ($expires) {

    $options = [];

    if ($expires !== 'never' && $expires !== '7' && $expires !== '30' && $expires !== '360') {
        if ($expires === '0') $text = 'today';
        elseif ($expires === '1') $text = 'tomorrow';
        else $text = "in $expires days";
        $options[$expires] = $text;
    }

    $options['never'] = 'never';
    $options['7'] = 'in 7 days';
    $options['30'] = 'in 30 days';
    $options['360'] = 'in 360 days';

    include_once __DIR__.'/../../../fns/Form/select.php';
    return Form\select('expires', 'Expires', $options, $expires);

}
