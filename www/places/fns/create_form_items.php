<?php

function create_form_items ($values, &$scripts, $base = '') {

    $focus = $values['focus'];
    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/compressed_js_script.php";
    $scripts = compressed_js_script('flexTextarea', "$base../../");

    include_once "$fnsDir/Places/maxLengths.php";
    $maxLengths = Places\maxLengths();

    include_once "$fnsDir/Form/tagsField.php";
    include_once "$fnsDir/Form/textarea.php";
    include_once "$fnsDir/Form/textfield.php";
    return
        Form\textfield('latitude', 'Latitude', [
            'value' => $values['latitude'],
            'autofocus' => $focus === 'latitude',
            'required' => true,
        ])
        .'<div class="hr"></div>'
        .Form\textfield('longitude', 'Longitude', [
            'value' => $values['longitude'],
            'autofocus' => $focus === 'longitude',
            'required' => true,
        ])
        .'<div class="hr"></div>'
        .Form\textfield('altitude', 'Altitude', [
            'value' => $values['altitude'],
        ])
        .'<div class="hr"></div>'
        .Form\textfield('name', 'Name', [
            'value' => $values['name'],
            'maxlength' => $maxLengths['name'],
        ])
        .'<div class="hr"></div>'
        .Form\textarea('description', 'Description', [
            'value' => $values['description'],
            'maxlength' => $maxLengths['description'],
        ])
        .'<div class="hr"></div>'
        .Form\tagsField($values['tags'], $focus === 'tags');

}
