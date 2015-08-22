<?php

include_once '../fns/note_method_page.php';
include_once '../../fns/true_result.php';
note_method_page('delete', [
    [
        'name' => 'id',
        'description' => 'The ID of the note to delete.',
    ],
], true_result(), [
    'NOTE_NOT_FOUND' => "A note with the ID doesn't exist.",
]);
