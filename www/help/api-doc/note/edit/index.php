<?php

include_once '../fns/note_method_page.php';
include_once '../../../../fns/Tags/maxNumber.php';
note_method_page('edit', [
    [
        'name' => 'id',
        'description' => 'The ID of the note to edit.',
    ],
    [
        'name' => 'text',
        'description' => 'The new text of the note.',
    ],
    [
        'name' => 'tags',
        'description' => 'Space-separated list of tags.',
    ],
], [
    'NOTE_NOT_FOUND' => "A note with the ID doesn't exist.",
    'ENTER_TEXT' => 'The new text is empty.',
    'TOO_MANY_TAGS' => 'More than '.Tags\maxNumber().' tags given.',
]);
