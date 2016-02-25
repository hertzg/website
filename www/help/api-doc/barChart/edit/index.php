<?php

include_once '../../../../../lib/defaults.php';

include_once '../fns/bar_chart_method_page.php';
include_once '../../../../fns/ApiDoc/trueResult.php';
include_once '../../../../fns/Tags/maxNumber.php';
bar_chart_method_page('edit', [
    [
        'name' => 'id',
        'description' => 'The ID of the bar chart to edit.',
    ],
    [
        'name' => 'name',
        'description' => 'The new name of the bar chart.',
    ],
    [
        'name' => 'tags',
        'description' => 'A space-separated list of tags.',
    ],
], ApiDoc\trueResult(), [
    'BAR_CHART_NOT_FOUND' => "A bar chart with the ID doesn't exist.",
    'ENTER_NAME' => 'The new name is empty.',
    'TOO_MANY_TAGS' => 'More than '.Tags\maxNumber().' tags given.',
]);
