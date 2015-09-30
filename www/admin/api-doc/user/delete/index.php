<?php

include_once '../fns/user_method_page.php';
include_once '../../fns/true_result.php';
user_method_page('delete', [
    [
        'name' => 'id',
        'description' => 'The ID of the user to delete.',
    ],
], true_result(), [
    'USER_NOT_FOUND' => "A user with the ID doesn't exist.",
]);
