<?php

include_once '../fns/note_method_page.php';
note_method_page('get', [
    [
        'name' => 'id',
        'description' => 'The ID of the note to get.',
    ],
], [
    'NOTE_NOT_FOUND' => "A note with the ID doesn't exist.",
]);
