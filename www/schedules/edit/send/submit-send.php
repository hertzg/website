<?php

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

    include_once "$fnsDir/Users/Schedules/Received/add.php";
    foreach ($receiver_id_userss as $receiver_id_users) {
        Users\Schedules\Received\add($mysqli,
            $user->id_users, $user->username, $receiver_id_users,
            $stageValues['text'], $stageValues['interval'],
            $stageValues['offset'], $stageValues['tags']);
    }

};

$sendExternalFunction = function ($recipients) use (
    $mysqli, $stageValues, $user, $fnsDir) {

    include_once "$fnsDir/Users/Schedules/Sending/add.php";
    foreach ($recipients as $recipient) {
        Users\Schedules\Sending\add($mysqli, $user, $recipient,
            $stageValues['text'], $stageValues['interval'],
            $stageValues['offset'], $stageValues['tags']);
    }

};

include_once "$fnsDir/SendForm/EditItem/submitSendPage.php";
SendForm\EditItem\submitSendPage($mysqli, $user, $id,
    'schedules/edit/send/errors', 'schedules/edit/send/messages',
    'schedules/edit/send/values', 'schedules/view/messages',
    $checkFunction, $sendFunction, $sendExternalFunction);
