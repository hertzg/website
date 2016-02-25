<?php

include_once '../../../../../lib/defaults.php';

include_once '../fns/note_method_page.php';
include_once '../../../../fns/ApiDoc/trueResult.php';
note_method_page('delete', [
    [
        'name' => 'id',
        'description' => 'The ID of the note to delete.',
    ],
], ApiDoc\trueResult(), [
    'NOTE_NOT_FOUND' => "A note with the ID doesn't exist.",
]);
