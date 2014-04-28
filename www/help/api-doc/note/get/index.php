<?php

include_once '../fns/note_method_page.php';
note_method_page('get', [
    [
        'name' => 'id',
        'description' => 'The ID of the note to get.',
    ],
]);
