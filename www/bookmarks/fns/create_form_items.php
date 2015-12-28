<?php

function create_form_items ($values) {

    $focus = $values['focus'];
    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/Bookmarks/maxLengths.php";
    $maxLengths = Bookmarks\maxLengths();

    include_once "$fnsDir/Form/tagsField.php";
    include_once "$fnsDir/Form/textfield.php";
    return
        Form\textfield('url', 'URL', [
            'value' => $values['url'],
            'maxlength' => $maxLengths['url'],
            'autofocus' => $focus === 'url',
            'required' => true,
        ])
        .'<div class="hr"></div>'
        .Form\textfield('title', 'Title', [
            'value' => $values['title'],
            'maxlength' => $maxLengths['title'],
        ])
        .'<div class="hr"></div>'
        .Form\tagsField($values['tags'], $focus === 'tags');

}
