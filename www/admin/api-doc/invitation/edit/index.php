<?php

include_once '../fns/invitation_method_page.php';
include_once '../../fns/true_result.php';
include_once '../../../../fns/Tags/maxNumber.php';
invitation_method_page('edit', [
    [
        'name' => 'id',
        'description' => 'The ID of the invitation to edit.',
    ],
    [
        'name' => 'note',
        'description' => 'The new note of the invitation.',
    ],
], true_result(), [
    'INVITATION_NOT_FOUND' => "An invitation with the ID doesn't exist.",
]);
