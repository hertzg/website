<?php

include_once '../../../../../../lib/defaults.php';

include_once '../fns/received_note_method_page.php';
received_note_method_page('importCopy', [
    [
        'name' => 'id',
        'description' => 'The ID of the received note to copy.',
    ],
], [
    'type' => 'number',
    'description' => 'The ID of the imported note.',
], [
    'RECEIVED_NOTE_NOT_FOUND' => "A received note with the ID doesn't exist.",
]);
