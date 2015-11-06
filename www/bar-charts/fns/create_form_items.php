<?php

function create_form_items ($values) {

    $focus = $values['focus'];
    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/BarCharts/maxLengths.php";
    $maxLengths = BarCharts\maxLengths();

    include_once "$fnsDir/Form/textfield.php";
    return
        Form\textfield('name', 'Name', [
            'value' => $values['name'],
            'maxlength' => $maxLengths['name'],
            'autofocus' => $focus === 'name',
            'required' => true,
        ])
        .'<div class="hr"></div>'
        .Form\textfield('tags', 'Tags', [
            'value' => $values['tags'],
            'maxlength' => $maxLengths['tags'],
            'autofocus' => $focus === 'tags',
        ]);

}
