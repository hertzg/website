<?php

include_once '../../../../../lib/defaults.php';

include_once '../fns/bar_chart_method_page.php';
include_once '../../../../fns/Tags/maxNumber.php';
bar_chart_method_page('add', [
    [
        'name' => 'name',
        'description' => 'The name of the bar chart.',
    ],
    [
        'name' => 'tags',
        'description' => 'A space-separated list of tags.',
    ],
], [
    'type' => 'number',
    'description' => 'The ID of the newly created bar chart.',
], [
    'ENTER_NAME' => 'The name is empty.',
    'TOO_MANY_TAGS' => 'More than '.Tags\maxNumber().' tags given.',
]);
