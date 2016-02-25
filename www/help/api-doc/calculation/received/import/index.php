<?php

include_once '../../../../../../lib/defaults.php';

include_once '../fns/received_calculation_method_page.php';
received_calculation_method_page('import', [
    [
        'name' => 'id',
        'description' => 'The ID of the received calculation to move.',
    ],
], [
    'type' => 'number',
    'description' => 'The ID of the imported calculation.',
], [
    'RECEIVED_CALCULATION_NOT_FOUND' =>
        "A received calculation with the ID doesn't exist.",
]);
