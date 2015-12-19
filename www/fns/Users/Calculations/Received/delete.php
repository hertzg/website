<?php

namespace Users\Calculations\Received;

function delete ($mysqli, $receivedCalculation, $apiKey = null) {

    include_once __DIR__.'/purge.php';
    purge($mysqli, $receivedCalculation);

    include_once __DIR__.'/../../DeletedItems/addReceivedCalculation.php';
    \Users\DeletedItems\addReceivedCalculation(
        $mysqli, $receivedCalculation, $apiKey);

}
