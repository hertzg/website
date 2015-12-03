<?php

function create_form_items ($user, $values, &$scripts, $base = '') {

    $focus = $values['focus'];
    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/user_time_today.php";
    $yearToday = date('Y', user_time_today($user));

    include_once "$fnsDir/compressed_js_script.php";
    $scripts = compressed_js_script('dateField', "$base../../");

    include_once "$fnsDir/Events/maxLengths.php";
    $maxLengths = Events\maxLengths();

    include_once "$fnsDir/Form/datefield.php";
    include_once "$fnsDir/Form/textfield.php";
    include_once "$fnsDir/Form/timefield.php";
    return
        Form\textfield('text', 'Text', [
            'value' => $values['text'],
            'maxlength' => $maxLengths['text'],
            'autofocus' => $focus === 'text',
            'required' => true,
        ])
        .'<div class="hr"></div>'
        .Form\datefield([
            'name' => 'event_day',
            'value' => $values['event_day'],
            'autofocus' => $focus === 'event_day',
        ],
        [
            'name' => 'event_month',
            'value' => $values['event_month'],
        ],
        [
            'name' => 'event_year',
            'value' => $values['event_year'],
            'min' => $yearToday - 100,
            'max' => $yearToday + 100,
        ], 'When', true)
        .'<div class="hr"></div>'
        .Form\timefield([
            'name' => 'start_hour',
            'value' => $values['start_hour'],
            'autofocus' => $focus === 'start_hour',
        ],
        [
            'name' => 'start_minute',
            'value' => $values['start_minute'],
        ], 'Start time', true);

}
