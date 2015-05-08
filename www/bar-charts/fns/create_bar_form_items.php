<?php

function create_bar_form_items ($values) {

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/BarChartBars/maxLengths.php";
    $maxLengths = BarChartBars\maxLengths();

    include_once "$fnsDir/Form/textfield.php";
    return
        Form\textfield('value', 'Value', [
            'value' => $values['value'],
            'autofocus' => true,
            'required' => true,
        ])
        .'<div class="hr"></div>'
        .Form\textfield('label', 'Label', [
            'value' => $values['label'],
            'maxlength' => $maxLengths['label'],
        ]);

}
