<?php

function require_received_place ($mysqli, $id_users) {

    $fnsDir = __DIR__.'/../../../../fns';

    include_once "$fnsDir/request_strings.php";
    list($id) = request_strings('id');

    $id = abs((int)$id);

    include_once "$fnsDir/ReceivedPlaces/getOnReceiver.php";
    $receivedPlace = ReceivedPlaces\getOnReceiver($mysqli, $id_users, $id);

    if (!$receivedPlace) {
        include_once __DIR__.'/../../../fns/bad_request.php';
        bad_request('RECEIVED_PLACE_NOT_FOUND');
    }

    return $receivedPlace;

}
