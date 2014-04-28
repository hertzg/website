<?php

include_once '../fns/note_method_page.php';
note_method_page('edit', [
    [
        'name' => 'id',
        'description' => 'The ID of the note to edit.',
    ],
    [
        'name' => 'text',
        'description' => 'The text of the note.',
    ],
    [
        'name' => 'tags',
        'description' => 'Space-separated list of tags.',
    ],
], ['NOTE_NOT_FOUND', 'ENTER_TEXT', 'TOO_MANY_TAGS']);
