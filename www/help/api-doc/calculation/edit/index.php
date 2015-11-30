<?php

include_once '../fns/calculation_method_page.php';
include_once '../../../../fns/ApiDoc/trueResult.php';
include_once '../../../../fns/Tags/maxNumber.php';
calculation_method_page('edit', [
    [
        'name' => 'id',
        'description' => 'The ID of the calculation to edit.',
    ],
    [
        'name' => 'url',
        'description' => 'The new URL of the calculation.',
    ],
    [
        'name' => 'title',
        'description' => 'The new title of the calculation.',
    ],
    [
        'name' => 'tags',
        'description' => 'A space-separated list of tags.',
    ],
], ApiDoc\trueResult(), [
    'CALCULATION_NOT_FOUND' => "A calculation with the ID doesn't exist.",
    'ENTER_URL' => 'The new URL is empty.',
    'TOO_MANY_TAGS' => 'More than '.Tags\maxNumber().' tags given.',
]);
