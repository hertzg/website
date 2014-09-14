<?php

function create_form_items ($base, $values) {

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/Tasks/maxLengths.php";
    $maxLengths = Tasks\maxLengths();

    include_once "$fnsDir/Form/checkbox.php";
    include_once "$fnsDir/Form/datefield.php";
    include_once "$fnsDir/Form/textarea.php";
    include_once "$fnsDir/Form/textfield.php";
    return
        Form\textarea('text', 'Text', [
            'value' => $values['text'],
            'maxlength' => $maxLengths['text'],
            'autofocus' => true,
            'required' => true,
        ])
        .'<div class="hr"></div>'
        .Form\datefield([
            'name' => 'deadline_day',
            'value' => $values['deadline_day'],
        ], [
            'name' => 'deadline_month',
            'value' => $values['deadline_month'],
        ], [
            'name' => 'deadline_year',
            'value' => $values['deadline_year'],
            'min' => date('Y'),
            'max' => date('Y') + 2,
        ], 'Deadline', false, true)
        .'<div class="hr"></div>'
        .Form\textfield('tags', 'Tags', [
            'value' => $values['tags'],
            'maxlength' => $maxLengths['tags'],
        ])
        .'<div class="hr"></div>'
        .Form\checkbox($base, 'top_priority',
            'Mark as Top Priority', $values['top_priority']);

}
