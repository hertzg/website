<?php

include_once '../../../../../../lib/defaults.php';

include_once '../fns/user_method_page.php';
include_once '../../../../../fns/Password/minLength.php';
user_method_page('add', [
    [
        'name' => 'username',
        'description' => 'The username of the user.',
    ],
    [
        'name' => 'email',
        'description' => 'The email of the user.',
    ],
    [
        'name' => 'full_name',
        'description' => 'The full name of the user.',
    ],
    [
        'name' => 'timezone',
        'description' => 'The timezone of the user.',
    ],
    [
        'name' => 'password',
        'description' => 'The password of the user.',
    ],
    [
        'name' => 'admin',
        'description' => 'Whether the user should be an administrator.',
    ],
    [
        'name' => 'disabled',
        'description' => 'Whether the user should be disabled.',
    ],
], [
    'type' => 'number',
    'description' => 'The ID of the newly created user.',
], [
    'ENTER_USERNAME' => 'The username is empty.',
    'INVALID_USERNAME' => 'The username is invalid.',
    'USERNAME_UNAVAILABLE' => 'The username is unavailable.',
    'INVALID_EMAIL' => 'The email is invalid.',
    'ENTER_PASSWORD' => 'The password is empty.',
    'PASSWORD_TOO_SHORT' =>
        'The password contains less than '.Password\minLength().' characters.',
    'PASSWORD_SAME' => 'The password is the same as the username.',
]);
