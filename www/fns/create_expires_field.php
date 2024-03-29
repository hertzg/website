<?php

function create_expires_field ($expires) {

    $options = [];

    if ($expires !== 'never' && $expires !== '7' &&
        $expires !== '30' && $expires !== '360') {

        if ($expires === '1') $text = 'Tomorrow';
        else $text = "In $expires days";
        $options[$expires] = $text;

    }

    $options['never'] = 'Never';
    $options['1'] = 'Tomorrow';
    $options['7'] = 'In a week';
    $options['30'] = 'In 30 days';
    $options['360'] = 'In 360 days';

    include_once __DIR__.'/Form/select.php';
    return Form\select('expires', 'Expires', $options, $expires);

}
