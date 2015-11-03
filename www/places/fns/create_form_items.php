<?php

function create_form_items ($values, &$scripts, $base = '') {

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/compressed_js_script.php";
    $scripts = compressed_js_script('flexTextarea', "$base../../");

    include_once "$fnsDir/Places/maxLengths.php";
    $maxLengths = Places\maxLengths();

    include_once "$fnsDir/Form/textarea.php";
    include_once "$fnsDir/Form/textfield.php";
    return
        Form\textfield('latitude', 'Latitude', [
            'value' => $values['latitude'],
            'autofocus' => true,
            'required' => true,
        ])
        .'<div class="hr"></div>'
        .Form\textfield('longitude', 'Longitude', [
            'value' => $values['longitude'],
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
        .Form\textfield('tags', 'Tags', [
            'value' => $values['tags'],
            'maxlength' => $maxLengths['tags'],
        ]);

}
