<?php

include_once '../fns/received_note_method_page.php';
received_note_method_page('import', [
    [
        'name' => 'id',
        'description' => 'The ID of the received note to move.',
    ],
], ['RECEIVED_NOTE_NOT_FOUND']);
