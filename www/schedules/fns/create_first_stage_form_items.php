<?php

function create_first_stage_form_items ($values) {

    $focus = $values['focus'];
    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/Schedules/maxLengths.php";
    $maxLengths = Schedules\maxLengths();

    include_once __DIR__.'/create_interval_select.php';
    include_once "$fnsDir/Form/button.php";
    include_once "$fnsDir/Form/tagsField.php";
    include_once "$fnsDir/Form/textfield.php";
    return
        Form\textfield('text', 'Text', [
            'value' => $values['text'],
            'maxlength' => $maxLengths['text'],
            'required' => true,
            'autofocus' => $focus === 'text',
        ])
        .'<div class="hr"></div>'
        .create_interval_select($values['interval'])
        .'<div class="hr"></div>'
        .Form\tagsField($values['tags'], $focus === 'tags')
        .Form\button('Next');

}
