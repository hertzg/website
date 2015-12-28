<?php

function create_form_items ($values, &$scripts, $base = '') {

    $focus = $values['focus'];
    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/compressed_js_script.php";
    $scripts = compressed_js_script('flexTextarea', "$base../../")
        .compressed_js_script('formCheckbox', "$base../../");

    include_once "$fnsDir/Notes/maxLengths.php";
    $maxLengths = Notes\maxLengths();

    include_once "$fnsDir/Form/checkbox.php";
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
        .Form\tagsField($values['tags'], $focus === 'tags')
        .'<div class="hr"></div>'
        .Form\checkbox('encrypt_in_listings',
            'Encrypt in listings', $values['encrypt_in_listings'])
        .'<div class="hr"></div>'
        .Form\checkbox('password_protect',
            'Password-protect', $values['password_protect']);

}
