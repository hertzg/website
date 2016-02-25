<?php

include_once '../../../../../../lib/defaults.php';

include_once '../fns/received_place_method_page.php';
include_once '../../../../../fns/ApiDoc/trueResult.php';
received_place_method_page('delete', [
    [
        'name' => 'id',
        'description' => 'The ID of the received place to delete.',
    ],
], ApiDoc\trueResult(), [
    'RECEIVED_PLACE_NOT_FOUND' => "A received place with the ID doesn't exist.",
]);
