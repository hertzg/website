<?php

namespace Form;

function tagsField ($value, $autofocus) {
    include_once __DIR__.'/notes.php';
    include_once __DIR__.'/textfield.php';
    include_once __DIR__.'/../Tags/maxLength.php';
    include_once __DIR__.'/../Tags/maxNumber.php';
    return
        textfield('tags', 'Tags', [
            'value' => $value,
            'maxlength' => \Tags\maxLength(),
            'autofocus' => $autofocus,
        ])
        .notes([
            'Multiple tags are separated by a space.',
            'Maximum '.\Tags\maxNumber().' tags.',
        ]);
}
