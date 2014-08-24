<?php

include_once '../fns/received_note_method_page.php';
received_note_method_page('delete', [
    [
        'name' => 'id',
        'description' => 'The ID of the received note to delete.',
    ],
], [
    'RECEIVED_NOTE_NOT_FOUND' => "A received note with the ID doesn't exist.",
]);
