<?php

include_once '../../../../../../lib/defaults.php';

include_once '../fns/place_point_method_page.php';
include_once '../../../../../fns/ApiDoc/trueResult.php';
place_point_method_page('delete', [
    [
        'name' => 'id',
        'description' => 'The ID of the point to delete.',
    ],
], ApiDoc\trueResult(), [
    'POINT_NOT_FOUND' => "A point with the ID doesn't exist.",
]);
