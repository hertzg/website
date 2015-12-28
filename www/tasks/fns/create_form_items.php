<?php

function create_form_items ($user, $values, &$scripts, $base = '') {

    $focus = $values['focus'];
    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/compressed_js_script.php";
    $scripts = compressed_js_script('dateField', "$base../../")
        .compressed_js_script('flexTextarea', "$base../../")
        .compressed_js_script('formCheckbox', "$base../../");

    include_once "$fnsDir/Tasks/maxLengths.php";
    $maxLengths = Tasks\maxLengths();

    include_once "$fnsDir/user_time_today.php";
    $yearToday = date('Y', user_time_today($user));

    include_once "$fnsDir/Form/checkbox.php";
    include_once "$fnsDir/Form/datefield.php";
    include_once "$fnsDir/Form/notes.php";
    include_once "$fnsDir/Form/tagsField.php";
    include_once "$fnsDir/Form/textarea.php";
    include_once "$fnsDir/Form/textfield.php";
    return
        Form\textarea('text', 'Text', [
            'value' => $values['text'],
            'maxlength' => $maxLengths['text'],
            'autofocus' => $focus === 'text',
            'required' => true,
        ])
        .'<div class="hr"></div>'
        .Form\datefield([
            'name' => 'deadline_day',
            'value' => $values['deadline_day'],
            'autofocus' => $focus === 'deadline_day',
        ], [
            'name' => 'deadline_month',
            'value' => $values['deadline_month'],
            'autofocus' => $focus === 'deadline_month',
        ], [
            'name' => 'deadline_year',
            'value' => $values['deadline_year'],
            'min' => $yearToday,
            'max' => $yearToday + 2,
            'autofocus' => $focus === 'deadline_year',
        ], 'Deadline', false, true)
        .Form\notes(['Today is '.date('l, F j', user_time_today($user)).'.'])
        .'<div class="hr"></div>'
        .Form\tagsField($values['tags'], $focus === 'tags')
        .'<div class="hr"></div>'
        .Form\checkbox('top_priority',
            'Mark as top priority', $values['top_priority']);

}
