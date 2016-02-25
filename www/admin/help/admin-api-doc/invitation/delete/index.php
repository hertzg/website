<?php

include_once '../../../../../../lib/defaults.php';

include_once '../fns/invitation_method_page.php';
include_once '../../../../../fns/ApiDoc/trueResult.php';
invitation_method_page('delete', [
    [
        'name' => 'id',
        'description' => 'The ID of the invitation to delete.',
    ],
], ApiDoc\trueResult(), [
    'INVITATION_NOT_FOUND' => "An invitation with the ID doesn't exist.",
]);
