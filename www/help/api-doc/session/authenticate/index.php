<?php

include_once '../../../../../lib/defaults.php';

include_once '../../../../fns/AuthRateLimit/number.php';
include_once '../../../../fns/AuthRateLimit/seconds.php';
include_once '../fns/session_method_page.php';
session_method_page('authenticate', [
    [
        'name' => 'username',
        'description' => 'The username of the user to authenticate.',
    ],
    [
        'name' => 'password',
        'description' => 'The password of the user to authenticate.',
    ],
    [
        'name' => 'remember',
        'description' => 'Remember the session.',
    ],
], [
    'ENTER_USERNAME' => 'The username is empty.',
    'INVALID_USERNAME' => 'The username is invalid.',
    'ENTER_PASSWORD' => 'The password is empty.',
    'INVALID_USERNAME_OR_PASSWORD' => 'The username or password is invalid.',
    'USER_DISABLED' => 'The user is disabled.',
    'RATE_LIMITED' => 'More than '.AuthRateLimit\number()
        .' attempts made from a client IP address in the last '
        .AuthRateLimit\seconds().' seconds.',
]);
