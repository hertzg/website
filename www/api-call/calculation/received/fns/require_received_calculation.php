<?php

function require_received_calculation ($mysqli, $user) {

    $fnsDir = __DIR__.'/../../../../fns';

    include_once "$fnsDir/request_strings.php";
    list($id) = request_strings('id');

    $id = abs((int)$id);

    include_once "$fnsDir/Users/Calculations/Received/get.php";
    $receivedCalculation = Users\Calculations\Received\get($mysqli, $user, $id);

    if (!$receivedCalculation) {
        include_once "$fnsDir/ApiCall/Error/badRequest.php";
        ApiCall\Error\badRequest('"RECEIVED_CALCULATION_NOT_FOUND"');
    }

    return $receivedCalculation;

}
