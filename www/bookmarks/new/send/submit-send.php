<?php

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

    include_once "$fnsDir/Users/Bookmarks/Received/add.php";
    foreach ($receiver_id_userss as $receiver_id_users) {
        Users\Bookmarks\Received\add($mysqli, $user->id_users,
            $user->username, $receiver_id_users, $stageValues['url'],
            $stageValues['title'], $stageValues['tags']);
    }

};

$sendExternalFunction = function ($recipients) use (
    $mysqli, $stageValues, $user, $fnsDir) {

    include_once "$fnsDir/SendingBookmarks/add.php";
    foreach ($recipients as $recipient) {
        SendingBookmarks\add($mysqli, $user->id_users,
            $user->username, $recipient['username'], $recipient['address'],
            $recipient['id_admin_connections'],
            $recipient['their_exchange_api_key'], $stageValues['url'],
            $stageValues['title'], $stageValues['tags']);
    }

};

include_once "$fnsDir/SendForm/NewItem/submitSendPage.php";
SendForm\NewItem\submitSendPage($mysqli, $user,
    'bookmarks/new/send/errors', 'bookmarks/new/send/messages',
    'bookmarks/new/send/values', 'bookmarks/messages',
    $checkFunction, $sendFunction, $sendExternalFunction);
