<?php

include_once '../../../lib/defaults.php';

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../../fns/require_user.php';
$user = require_user('../../');

include_once '../fns/request_place_params.php';
list($latitude, $longitude, $altitude, $name, $description,
    $tags, $tag_names, $parsed_latitude, $parsed_longitude,
    $parsed_altitude) = request_place_params($errors, $focus);

$values = [
    'focus' => $focus,
    'latitude' => $latitude,
    'longitude' => $longitude,
    'altitude' => $altitude,
    'name' => $name,
    'description' => $description,
    'tags' => $tags,
];

$_SESSION['places/new/values'] = $values;

include_once '../../fns/redirect.php';

if ($errors) {
    $_SESSION['places/new/errors'] = $errors;
    include_once '../../fns/ItemList/pageQuery.php';
    redirect('./'.ItemList\pageQuery());
}

unset($_SESSION['places/new/errors']);

include_once '../../fns/request_strings.php';
list($sendButton) = request_strings('sendButton');
if ($sendButton !== '') {
    $values['latitude'] = $parsed_latitude;
    $values['longitude'] = $parsed_longitude;
    $values['altitude'] = $parsed_altitude;
    $_SESSION['places/new/send/place'] = $values;
    unset(
        $_SESSION['places/new/send/errors'],
        $_SESSION['places/new/send/messages'],
        $_SESSION['places/new/send/values']
    );
    include_once '../../fns/ItemList/pageQuery.php';
    redirect('send/'.ItemList\pageQuery());
}

unset($_SESSION['places/new/values']);

include_once '../../fns/Users/Places/add.php';
include_once '../../lib/mysqli.php';
$id = Users\Places\add($mysqli, $user->id_users,
    $parsed_latitude, $parsed_longitude, $parsed_altitude,
    $name, $description, $tags, $tag_names);

$_SESSION['places/view/messages'] = ['Place has been saved.'];

include_once '../../fns/ItemList/itemQuery.php';
redirect('../view/'.ItemList\itemQuery($id));
