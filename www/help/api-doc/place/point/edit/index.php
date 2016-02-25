<?php

include_once '../../../../../../lib/defaults.php';

include_once '../fns/place_point_method_page.php';
include_once '../../../../../fns/ApiDoc/trueResult.php';
place_point_method_page('edit', [
    [
        'name' => 'id',
        'description' => 'The ID of the point to edit.',
    ],
    [
        'name' => 'latitude',
        'description' => 'The new latitude of the point.',
    ],
    [
        'name' => 'longitude',
        'description' => 'The new longitude of the point.',
    ],
    [
        'name' => 'altitude',
        'description' => 'The new altitude of the point.',
    ],
], ApiDoc\trueResult(), [
    'POINT_NOT_FOUND' => "A point with the ID doesn't exist.",
]);
