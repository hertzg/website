<?php

include_once '../../../../lib/defaults.php';

$fnsDir = '../../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('../..');

include_once 'fns/require_stage.php';
include_once '../../../lib/mysqli.php';
list($user, $stageValues, $id) = require_stage($mysqli);

$checkFunction = function ($recipients,
    &$receiver_id_userss, &$errors) use ($mysqli, $user) {

    include_once '../../fns/check_receivers.php';
    check_receivers($mysqli, $user->id_users,
        $recipients, $receiver_id_userss, $errors);

};

$sendFunction = function ($receiver_id_userss) use (
    $mysqli, $stageValues, $user, $fnsDir) {

    include_once "$fnsDir/Users/Places/Received/add.php";
    foreach ($receiver_id_userss as $receiver_id_users) {
        Users\Places\Received\add($mysqli, $user->id_users,
            $user->username, $receiver_id_users, $stageValues['latitude'],
            $stageValues['longitude'], $stageValues['altitude'],
            $stageValues['name'], $stageValues['description'],
            $stageValues['tags']);
    }

};

$sendExternalFunction = function ($recipients) use (
    $mysqli, $stageValues, $user, $fnsDir) {

    include_once "$fnsDir/Users/Places/Sending/add.php";
    foreach ($recipients as $recipient) {
        Users\Places\Sending\add($mysqli, $user, $recipient,
            $stageValues['latitude'], $stageValues['longitude'],
            $stageValues['altitude'], $stageValues['name'],
            $stageValues['description'], $stageValues['tags']);
    }

};

include_once "$fnsDir/SendForm/EditItem/submitSendPage.php";
SendForm\EditItem\submitSendPage($mysqli, $user, $id,
    'places/edit/send/errors', 'places/edit/send/messages',
    'places/edit/send/values', 'places/view/messages',
    $checkFunction, $sendFunction, $sendExternalFunction);
