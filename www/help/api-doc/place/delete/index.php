<?php

include_once '../../../../../lib/defaults.php';

include_once '../fns/place_method_page.php';
include_once '../../../../fns/ApiDoc/trueResult.php';
place_method_page('delete', [
    [
        'name' => 'id',
        'description' => 'The ID of the place to delete.',
    ],
], ApiDoc\trueResult(), [
    'PLACE_NOT_FOUND' => "A place with the ID doesn't exist.",
]);
