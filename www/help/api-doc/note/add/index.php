<?php

include_once '../fns/note_method_page.php';
include_once '../../../../fns/Tags/maxNumber.php';
note_method_page('add', [
    [
        'name' => 'text',
        'description' => 'The text of the note.',
    ],
    [
        'name' => 'tags',
        'description' => 'Space-separated list of tags.',
    ],
], [
    'ENTER_TEXT' => 'The text is empty.',
    'TOO_MANY_TAGS' => 'More than '.Tags\maxNumber().' tags given.',
]);
