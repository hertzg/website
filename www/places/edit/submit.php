<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('..');

include_once '../fns/require_place.php';
include_once '../../lib/mysqli.php';
list($place, $id, $user) = require_place($mysqli);

$errors = [];

include_once '../fns/request_place_params.php';
list($latitude, $longitude, $altitude, $name, $tags,
    $tag_names, $parsed_latitude, $parsed_longitude,
    $parsed_altitude) = request_place_params($errors);

include_once '../../fns/ItemList/itemQuery.php';
$itemQuery = ItemList\itemQuery($id);

$values = [
    'latitude' => $latitude,
    'longitude' => $longitude,
    'altitude' => $altitude,
    'name' => $name,
    'tags' => $tags,
];

$_SESSION['places/edit/values'] = $values;

include_once '../../fns/redirect.php';

if ($errors) {
    $_SESSION['places/edit/errors'] = $errors;
    redirect("./$itemQuery");
}

unset($_SESSION['places/edit/errors']);

include_once '../../fns/request_strings.php';
list($sendButton) = request_strings('sendButton');
if ($sendButton) {
    unset(
        $_SESSION['places/edit/send/errors'],
        $_SESSION['places/edit/send/messages'],
        $_SESSION['places/edit/send/values']
    );
    $values['latitude'] = $parsed_latitude;
    $values['longitude'] = $parsed_longitude;
    $values['altitude'] = $parsed_altitude;
    $_SESSION['places/edit/send/place'] = $values;
    redirect("send/$itemQuery");
}

unset($_SESSION['places/edit/values']);

include_once '../../fns/Users/Places/edit.php';
Users\Places\edit($mysqli, $place, $parsed_latitude,
    $parsed_longitude, $parsed_altitude, $name, $tags, $tag_names);

$_SESSION['places/view/messages'] = ['Changes have been saved.'];
redirect("../view/$itemQuery");