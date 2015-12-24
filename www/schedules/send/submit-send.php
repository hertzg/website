<?php

$fnsDir = '../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('..');

include_once '../fns/require_schedule.php';
include_once '../../lib/mysqli.php';
list($schedule, $id, $user) = require_schedule($mysqli);

$checkFunction = function ($recipients,
    &$receiver_id_userss, &$errors) use ($mysqli, $user) {

    include_once '../fns/check_receivers.php';
    check_receivers($mysqli, $user->id_users,
        $recipients, $receiver_id_userss, $errors);

};

$sendFunction = function ($receiver_id_userss) use (
    $mysqli, $schedule, $user, $fnsDir) {

    include_once "$fnsDir/Users/Schedules/send.php";
    foreach ($receiver_id_userss as $receiver_id_users) {
        Users\Schedules\send($mysqli, $user, $receiver_id_users, $schedule);
    }

};

$sendExternalFunction = function ($recipients) use (
    $mysqli, $schedule, $user, $fnsDir) {

    include_once "$fnsDir/Users/Schedules/Sending/add.php";
    foreach ($recipients as $recipient) {
        Users\Schedules\Sending\add($mysqli, $user, $recipient,
            $schedule->text, $schedule->interval,
            $schedule->offset, $schedule->tags);
    }

};

include_once "$fnsDir/SendForm/submitSendPage.php";
SendForm\submitSendPage($mysqli, $user, $id,
    'schedules/send/errors', 'schedules/send/messages',
    'schedules/send/values', 'schedules/view/messages',
    $checkFunction, $sendFunction, $sendExternalFunction);
