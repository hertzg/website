<?php

include_once '../../../lib/defaults.php';

$fnsDir = '../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('..');

include_once 'fns/require_computable_calculation.php';
include_once '../../lib/mysqli.php';
list($calculation, $id, $user) = require_computable_calculation($mysqli);

$checkFunction = function ($recipients,
    &$receiver_id_userss, &$errors) use ($mysqli, $user) {

    include_once '../fns/check_receivers.php';
    check_receivers($mysqli, $user->id_users,
        $recipients, $receiver_id_userss, $errors);

};

$sendFunction = function ($receiver_id_userss) use (
    $mysqli, $calculation, $user, $fnsDir) {

    include_once "$fnsDir/Users/Calculations/send.php";
    foreach ($receiver_id_userss as $receiver_id_users) {
        Users\Calculations\send($mysqli,
            $user, $receiver_id_users, $calculation);
    }

};

$sendExternalFunction = function ($recipients) use (
    $mysqli, $calculation, $user, $fnsDir) {

    include_once "$fnsDir/Users/Calculations/Sending/add.php";
    foreach ($recipients as $recipient) {
        Users\Calculations\Sending\add($mysqli, $user,
            $recipient, $calculation->resolved_expression,
            $calculation->title, $calculation->tags);
    }

};

include_once "$fnsDir/SendForm/submitSendPage.php";
SendForm\submitSendPage($mysqli, $user, $id,
    'calculations/send/errors', 'calculations/send/messages',
    'calculations/send/values', 'calculations/view/messages',
    $checkFunction, $sendFunction, $sendExternalFunction,
    'calculations/view/errors');
