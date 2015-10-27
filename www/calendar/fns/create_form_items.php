<?php

function create_form_items ($text, $event_day, $event_month,
    $event_year, $start_hour, $start_minute, &$scripts, $base = '') {

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/compressed_js_script.php";
    $scripts = compressed_js_script('dateField', "$base../../");

    include_once "$fnsDir/Events/maxLengths.php";
    $maxLengths = Events\maxLengths();

    include_once "$fnsDir/Form/datefield.php";
    include_once "$fnsDir/Form/textfield.php";
    include_once "$fnsDir/Form/timefield.php";
    return
        Form\datefield([
            'name' => 'event_day',
            'value' => $event_day,
        ],
        [
            'name' => 'event_month',
            'value' => $event_month,
        ],
        [
            'name' => 'event_year',
            'value' => $event_year,
        ], 'When', true)
        .'<div class="hr"></div>'
        .Form\timefield([
            'name' => 'start_hour',
            'value' => $start_hour,
        ],
        [
            'name' => 'start_minute',
            'value' => $start_minute,
        ], 'Start time', true)
        .'<div class="hr"></div>'
        .Form\textfield('text', 'Text', [
            'value' => $text,
            'maxlength' => $maxLengths['text'],
            'autofocus' => true,
            'required' => true,
        ]);

}
