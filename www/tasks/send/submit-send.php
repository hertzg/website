<?php

$fnsDir = '../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('..');

include_once '../fns/require_task.php';
include_once '../../lib/mysqli.php';
list($task, $id, $user) = require_task($mysqli);

$checkFunction = function ($recipients,
    &$receiver_id_userss, &$errors) use ($mysqli, $user) {

    include_once '../fns/check_receivers.php';
    check_receivers($mysqli, $user->id_users,
        $recipients, $receiver_id_userss, $errors);

};

$sendFunction = function ($receiver_id_userss) use (
    $mysqli, $task, $user, $fnsDir) {

    include_once "$fnsDir/Users/Tasks/send.php";
    foreach ($receiver_id_userss as $receiver_id_users) {
        Users\Tasks\send($mysqli, $user, $receiver_id_users, $task);
    }

};

$sendExternalFunction = function ($recipients) use (
    $mysqli, $task, $user, $fnsDir) {

    include_once "$fnsDir/SendingTasks/add.php";
    foreach ($recipients as $recipient) {
        SendingTasks\add($mysqli, $user->id_users, $user->username,
            $recipient['username'], $recipient['address'],
            $recipient['id_admin_connections'],
            $recipient['their_exchange_api_key'], $task->text,
            $task->deadline_time, $task->tags, $task->top_priority);
    }

};

include_once "$fnsDir/SendForm/submitSendPage.php";
SendForm\submitSendPage($mysqli, $user, $id, 'tasks/send/errors',
    'tasks/send/messages', 'tasks/send/values', 'tasks/view/messages',
    $checkFunction, $sendFunction, $sendExternalFunction);
