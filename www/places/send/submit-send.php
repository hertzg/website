<?php

$fnsDir = '../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('..');

include_once '../fns/require_place.php';
include_once '../../lib/mysqli.php';
list($place, $id, $user) = require_place($mysqli);

$checkFunction = function ($recipients,
    &$receiver_id_userss, &$errors) use ($mysqli, $user) {

    include_once '../fns/check_receivers.php';
    check_receivers($mysqli, $user->id_users,
        $recipients, $receiver_id_userss, $errors);

};

$sendFunction = function ($receiver_id_userss) use (
    $mysqli, $place, $user, $fnsDir) {

    include_once "$fnsDir/Users/Places/send.php";
    foreach ($receiver_id_userss as $receiver_id_users) {
        Users\Places\send($mysqli, $user, $receiver_id_users, $place);
    }

};

$sendExternalFunction = function ($recipients) use (
    $mysqli, $place, $user, $fnsDir) {

    include_once "$fnsDir/SendingPlaces/add.php";
    foreach ($recipients as $recipient) {
        SendingPlaces\add($mysqli, $user->id_users, $user->username,
            $recipient['username'], $recipient['address'],
            $recipient['id_admin_connections'],
            $recipient['their_exchange_api_key'], $place->latitude,
            $place->longitude, $place->altitude, $place->name,
            $place->description, $place->tags);
    }

};

include_once "$fnsDir/SendForm/submitSendPage.php";
SendForm\submitSendPage($mysqli, $user, $id, 'places/send/errors',
    'places/send/messages', 'places/send/values', 'places/view/messages',
    $checkFunction, $sendFunction, $sendExternalFunction);
