<?php

namespace Users\Places\Received;

function delete ($mysqli, $receivedPlace, $apiKey = null) {

    include_once __DIR__.'/purge.php';
    purge($mysqli, $receivedPlace);

    include_once __DIR__.'/../../DeletedItems/addReceivedPlace.php';
    \Users\DeletedItems\addReceivedPlace($mysqli, $receivedPlace, $apiKey);

}
