<?php

include_once '../fns/invitation_method_page.php';
include_once '../../fns/true_result.php';
invitation_method_page('delete', [
    [
        'name' => 'id',
        'description' => 'The ID of the invitation to delete.',
    ],
], true_result(), [
    'INVITATION_NOT_FOUND' => "An invitation with the ID doesn't exist.",
]);
