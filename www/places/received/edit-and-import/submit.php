<?php

$fnsDir = '../../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('..');

include_once '../fns/require_received_place.php';
include_once '../../../lib/mysqli.php';
list($receivedPlace, $id, $user) = require_received_place($mysqli, '../');

$errors = [];

include_once '../../fns/request_place_params.php';
list($latitude, $longitude, $altitude, $name, $tags,
    $tag_names, $parsed_latitude, $parsed_longitude,
    $parsed_altitude) = request_place_params($errors);

include_once "$fnsDir/redirect.php";

if ($errors) {
    $_SESSION['places/received/edit-and-import/errors'] = $errors;
    $_SESSION['places/received/edit-and-import/values'] = [
        'latitude' => $latitude,
        'longitude' => $longitude,
        'altitude' => $altitude,
        'name' => $name,
        'tags' => $tags,
    ];
    include_once "$fnsDir/ItemList/Received/itemQuery.php";
    redirect('./'.ItemList\Received\itemQuery($id));
}

unset(
    $_SESSION['places/received/edit-and-import/errors'],
    $_SESSION['places/received/edit-and-import/values']
);

$receivedPlace->latitude = $parsed_latitude;
$receivedPlace->longitude = $parsed_longitude;
$receivedPlace->altitude = $parsed_altitude;
$receivedPlace->name = $name;
$receivedPlace->tags = $tags;

include_once "$fnsDir/Users/Places/Received/import.php";
Users\Places\Received\import($mysqli, $receivedPlace);

$messages = ['Place has been imported.'];

if ($user->num_received_places == 1) {
    $messages[] = 'No more received places.';
    $_SESSION['places/messages'] = $messages;
    unset($_SESSION['places/errors']);
    redirect('../..');
}

$_SESSION['places/received/messages'] = $messages;

include_once "$fnsDir/ItemList/Received/listUrl.php";
redirect('../'.ItemList\Received\listUrl());
