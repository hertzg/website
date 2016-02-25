<?php

include_once '../../../../../lib/defaults.php';

include_once '../fns/calculation_method_page.php';
include_once '../../../../fns/Tags/maxNumber.php';
calculation_method_page('add', [
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
], [
    'type' => 'number',
    'description' => 'The ID of the newly created calculation.',
], [
    'ENTER_EXPRESSION' => 'The expression is empty.',
    'INVALID_EXPRESSION' => 'The expression is invalid.',
    'TOO_MANY_TAGS' => 'More than '.Tags\maxNumber().' tags given.',
]);
