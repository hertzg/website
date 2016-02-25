<?php

include_once '../../../../../lib/defaults.php';

include_once '../fns/calculation_method_page.php';
include_once '../../../../fns/ApiDoc/trueResult.php';
include_once '../../../../fns/Tags/maxNumber.php';
calculation_method_page('send', [
    [
        'name' => 'receiver_username',
        'description' => 'The Zvini username of the receiver.',
    ],
    [
        'name' => 'expression',
        'description' => 'The expression of the calculation.',
    ],
    [
        'name' => 'title',
        'description' => 'The title of the calculation.',
    ],
    [
        'name' => 'tags',
        'description' => 'A space-separated list of tags.',
    ],
], ApiDoc\trueResult(), [
    'ENTER_RECEIVER_USERNAME' => 'The receiver username is empty.',
    'INVALID_RECEIVER_USERNAME' => 'The receiver username is invalid.',
    'RECEIVER_NOT_FOUND' => 'No such receiver with the username.',
    'RECEIVER_NOT_RECEIVING' =>
        "The receiver hasn't opened a connection"
        .' to receive calculations from you.',
    'ENTER_EXPRESSION' => 'The expression is empty.',
    'INVALID_EXPRESSION' => 'The expression is invalid.',
    'TOO_MANY_TAGS' => 'More than '.Tags\maxNumber().' tags given.',
]);
