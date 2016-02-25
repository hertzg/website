<?php

include_once '../../../../../../lib/defaults.php';

include_once '../fns/user_method_page.php';
include_once '../../../../../fns/ApiDoc/trueResult.php';
include_once '../../../../../fns/Password/minLength.php';
user_method_page('resetPassword', [
    [
        'name' => 'id',
        'description' => 'The ID of the user to reset the password of.',
    ],
    [
        'name' => 'password',
        'description' => 'The new password of the user.',
    ],
], ApiDoc\trueResult(), [
    'USER_NOT_FOUND' => "A user with the ID doesn't exist.",
    'ENTER_PASSWORD' => 'The password is empty.',
    'PASSWORD_TOO_SHORT' =>
        'The password contains less than '.Password\minLength().' characters.',
    'PASSWORD_SAME' => 'The password is the same as the username.',
]);
