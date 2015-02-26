<?php

function require_received_place ($mysqli, $user) {

    $fnsDir = __DIR__.'/../../../../fns';

    include_once "$fnsDir/request_strings.php";
    list($id) = request_strings('id');

    $id = abs((int)$id);

    include_once "$fnsDir/Users/Places/Received/get.php";
    $receivedPlace = Users\Places\Received\get($mysqli, $user, $id);

    if (!$receivedPlace) {
        include_once __DIR__.'/../../../fns/bad_request.php';
        bad_request('RECEIVED_PLACE_NOT_FOUND');
    }

    return $receivedPlace;

}
