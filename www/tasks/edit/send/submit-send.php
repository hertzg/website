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

    include_once "$fnsDir/Users/Tasks/Received/add.php";
    foreach ($receiver_id_userss as $receiver_id_users) {
        Users\Tasks\Received\add($mysqli, $user->id_users,
            $user->username, $receiver_id_users, $stageValues['text'],
            $stageValues['deadline_time'], $stageValues['tags'],
            $stageValues['top_priority']);
    }

};

include_once "$fnsDir/SendForm/EditItem/submitSendPage.php";
SendForm\EditItem\submitSendPage($user, $id, 'tasks/edit/send/errors',
    'tasks/edit/send/messages', 'tasks/edit/send/values',
    'tasks/view/messages', $checkFunction, $sendFunction);
