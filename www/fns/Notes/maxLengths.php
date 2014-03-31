<?php

namespace Notes;

function maxLengths () {
    include_once __DIR__.'/../Tags/maxLength.php';
    return [
        'note_text' => 1024,
        'tags' => \Tags\maxLength(),
    ];
}
