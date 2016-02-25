<?php

include_once '../../../../../../lib/defaults.php';

include_once '../fns/user_method_page.php';
include_once '../../../../../fns/ApiDoc/trueResult.php';
user_method_page('editProfile', [
    [
        'name' => 'id',
        'description' => 'The ID of the user to edit the profile of.',
    ],
    [
        'name' => 'username',
        'description' => 'The new username of the user.',
    ],
    [
        'name' => 'admin',
        'description' => 'Whether the user should be an administrator.',
    ],
    [
        'name' => 'disabled',
        'description' => 'Whether the user should be disabled.',
    ],
], ApiDoc\trueResult(), [
    'USER_NOT_FOUND' => "A user with the ID doesn't exist.",
    'ENTER_USERNAME' => 'The username is empty.',
    'INVALID_USERNAME' => 'The username is invalid.',
    'USERNAME_UNAVAILABLE' => 'The username is unavailable.',
    'USERNAME_SAME' => 'The usernae is the same as the password.',
]);
