<?php

include_once '../../../../../../lib/defaults.php';

include_once '../fns/user_method_page.php';
include_once '../../../../../fns/ApiDoc/trueResult.php';
user_method_page('delete', [
    [
        'name' => 'id',
        'description' => 'The ID of the user to delete.',
    ],
], ApiDoc\trueResult(), [
    'USER_NOT_FOUND' => "A user with the ID doesn't exist.",
]);
