<?php

include_once '../../../../../lib/defaults.php';

include_once '../fns/calculation_method_page.php';
include_once '../../../../fns/ApiDoc/trueResult.php';
calculation_method_page('delete', [
    [
        'name' => 'id',
        'description' => 'The ID of the calculation to delete.',
    ],
], ApiDoc\trueResult(), [
    'CALCULATION_NOT_FOUND' => "A calculation with the ID doesn't exist.",
]);
