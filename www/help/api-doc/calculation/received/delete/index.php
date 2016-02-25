<?php

include_once '../../../../../../lib/defaults.php';

include_once '../fns/received_calculation_method_page.php';
include_once '../../../../../fns/ApiDoc/trueResult.php';
received_calculation_method_page('delete', [
    [
        'name' => 'id',
        'description' => 'The ID of the received calculation to delete.',
    ],
], ApiDoc\trueResult(), [
    'RECEIVED_CALCULATION_NOT_FOUND' =>
        "A received calculation with the ID doesn't exist.",
]);
