<?php

namespace Users\Calculations\Received;

function import ($mysqli,
    $receivedCalculation, $depends, $insertApiKey = null) {

    include_once __DIR__.'/importCopy.php';
    $id = importCopy($mysqli, $receivedCalculation, $depends, $insertApiKey);

    include_once __DIR__.'/purge.php';
    purge($mysqli, $receivedCalculation);

    return $id;

}
