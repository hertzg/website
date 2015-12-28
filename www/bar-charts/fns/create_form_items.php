<?php

function create_form_items ($values) {

    $focus = $values['focus'];
    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/BarCharts/maxLengths.php";
    $maxLengths = BarCharts\maxLengths();

    include_once "$fnsDir/Form/tagsField.php";
    include_once "$fnsDir/Form/textfield.php";
    return
        Form\textfield('name', 'Name', [
            'value' => $values['name'],
            'maxlength' => $maxLengths['name'],
            'autofocus' => $focus === 'name',
            'required' => true,
        ])
        .'<div class="hr"></div>'
        .Form\tagsField($values['tags'], $focus === 'tags');

}
