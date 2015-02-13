<?php

function create_form_items ($text, $event_day, $event_month, $event_year) {

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/Events/maxLengths.php";
    $maxLengths = Events\maxLengths();

    include_once "$fnsDir/Form/datefield.php";
    include_once "$fnsDir/Form/textfield.php";
    return Form\datefield([
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
    .Form\textfield('text', 'Text', [
        'value' => $text,
        'maxlength' => $maxLengths['text'],
        'autofocus' => true,
        'required' => true,
    ]);

}
