<?php

function require_calculation ($mysqli, $user) {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/request_strings.php";
    list($id) = request_strings('id');

    $id = abs((int)$id);

    include_once "$fnsDir/Users/Calculations/get.php";
    $calculation = Users\Calculations\get($mysqli, $user, $id);

    if (!$calculation) {
        include_once "$fnsDir/ErrorJson/badRequest.php";
        ErrorJson\badRequest('"CALCULATION_NOT_FOUND"');
    }

    return $calculation;

}
