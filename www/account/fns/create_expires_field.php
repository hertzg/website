<?php

function create_expires_field ($expires) {

    $options = [];

    if ($expires !== 'never' && $expires !== '7' &&
        $expires !== '30' && $expires !== '360') {

        if ($expires === '0') $text = 'Today';
        elseif ($expires === '1') $text = 'Tomorrow';
        else $text = "In $expires days";
        $options[$expires] = $text;

    }

    $options['never'] = 'Never';
    $options['7'] = 'In 7 days';
    $options['30'] = 'In 30 days';
    $options['360'] = 'In 360 days';

    include_once __DIR__.'/../../fns/Form/select.php';
    return Form\select('expires', 'Expires', $options, $expires);

}
