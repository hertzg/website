<?php

function create_form_items ($values) {

    $focus = $values['focus'];
    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/Calculations/maxLengths.php";
    $maxLengths = Calculations\maxLengths();

    include_once "$fnsDir/Form/notes.php";
    include_once "$fnsDir/Form/tagsField.php";
    include_once "$fnsDir/Form/textfield.php";
    return
        Form\textfield('expression', 'Expression', [
            'value' => $values['expression'],
            'maxlength' => $maxLengths['expression'],
            'autofocus' => $focus === 'expression',
            'required' => true,
        ])
        .Form\notes([
            'Example: 3 + 5 - 2 * (4 + 6 / 3.5)',
            'Reference other calculations with #id syntax.',
        ])
        .'<div class="hr"></div>'
        .Form\textfield('title', 'Title', [
            'value' => $values['title'],
            'maxlength' => $maxLengths['title'],
        ])
        .'<div class="hr"></div>'
        .Form\tagsField($values['tags'], $focus === 'tags');

}
