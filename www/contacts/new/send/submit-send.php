<?php

include_once '../../../../lib/defaults.php';

$fnsDir = '../../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('./');

include_once 'fns/require_stage.php';
list($user, $stageValues) = require_stage();

include_once '../../../lib/mysqli.php';
$checkFunction = function ($recipients,
    &$receiver_id_userss, &$errors) use ($mysqli, $user) {

    include_once '../../fns/check_receivers.php';
    check_receivers($mysqli, $user->id_users,
        $recipients, $receiver_id_userss, $errors);

};

$sendFunction = function ($receiver_id_userss) use (
    $mysqli, $stageValues, $user, $fnsDir) {

    include_once "$fnsDir/Users/Contacts/Received/add.php";
    foreach ($receiver_id_userss as $receiver_id_users) {
        Users\Contacts\Received\add($mysqli, $user->id_users,
            $user->username, $receiver_id_users, $stageValues['full_name'],
            $stageValues['alias'], $stageValues['address'],
            $stageValues['email1'], $stageValues['email1_label'],
            $stageValues['email2'], $stageValues['email2_label'],
            $stageValues['phone1'], $stageValues['phone1_label'],
            $stageValues['phone2'], $stageValues['phone2_label'],
            $stageValues['birthday_time'], $stageValues['username'],
            $stageValues['timezone'], $stageValues['tags'],
            $stageValues['notes'], $stageValues['favorite'], null);
    }

};

$sendExternalFunction = function ($recipients) use (
    $mysqli, $stageValues, $user, $fnsDir) {

    include_once "$fnsDir/Users/Contacts/Sending/add.php";
    foreach ($recipients as $recipient) {
        Users\Contacts\Sending\add($mysqli, $user,
            $recipient, $stageValues['full_name'],
            $stageValues['alias'], $stageValues['address'],
            $stageValues['email1'], $stageValues['email1_label'],
            $stageValues['email2'], $stageValues['email2_label'],
            $stageValues['phone1'], $stageValues['phone1_label'],
            $stageValues['phone2'], $stageValues['phone2_label'],
            $stageValues['birthday_time'], $stageValues['username'],
            $stageValues['timezone'], $stageValues['tags'],
            $stageValues['notes'], $stageValues['favorite']);
    }

};

include_once "$fnsDir/SendForm/NewItem/submitSendPage.php";
SendForm\NewItem\submitSendPage($mysqli, $user,
    'contacts/new/send/errors', 'contacts/new/send/messages',
    'contacts/new/send/values', 'contacts/messages',
    $checkFunction, $sendFunction, $sendExternalFunction);
