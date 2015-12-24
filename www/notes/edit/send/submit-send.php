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

    include_once "$fnsDir/Users/Notes/Received/add.php";
    foreach ($receiver_id_userss as $receiver_id_users) {
        Users\Notes\Received\add($mysqli, $user->id_users, $user->username,
            $receiver_id_users, $stageValues['text'], $stageValues['tags'],
            $stageValues['encrypt_in_listings']);
    }

};

$sendExternalFunction = function ($recipients) use (
    $mysqli, $stageValues, $user, $fnsDir) {

    include_once "$fnsDir/Users/Notes/Sending/add.php";
    foreach ($recipients as $recipient) {
        Users\Notes\Sending\add($mysqli, $user, $recipient,
            $stageValues['text'], $stageValues['tags'],
            $stageValues['encrypt_in_listings']);
    }

};

include_once "$fnsDir/SendForm/EditItem/submitSendPage.php";
SendForm\EditItem\submitSendPage($mysqli, $user, $id,
    'notes/edit/send/errors', 'notes/edit/send/messages',
    'notes/edit/send/values', 'notes/view/messages',
    $checkFunction, $sendFunction, $sendExternalFunction);
