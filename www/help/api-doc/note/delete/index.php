<?php

include_once '../fns/note_method_page.php';
note_method_page('delete', [
    [
        'name' => 'id',
        'description' => 'The ID of the note to delete.',
    ],
]);
