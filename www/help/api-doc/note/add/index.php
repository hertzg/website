<?php

include_once '../fns/note_method_page.php';
note_method_page('add', [
    [
        'name' => 'text',
        'description' => 'The text of the note.',
    ],
    [
        'name' => 'tags',
        'description' => 'Space-separated list of tags.',
    ],
]);
