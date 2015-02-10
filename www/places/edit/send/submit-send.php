<?php

include_once '../../../fns/require_same_domain_referer.php';
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

$sendFunction = function ($receiver_id_userss) use ($mysqli,
    $stageValues, $user) {

    include_once '../../../fns/Users/Places/Received/add.php';
    foreach ($receiver_id_userss as $receiver_id_users) {
        Users\Places\Received\add($mysqli, $user->id_users,
            $user->username, $receiver_id_users, $stageValues['latitude'],
            $stageValues['longitude'], $stageValues['name'],
            $stageValues['tags']);
    }

};

include_once '../../../fns/SendForm/EditItem/submitSendPage.php';
SendForm\EditItem\submitSendPage($user, $id, 'places/edit/send/errors',
    'places/edit/send/messages', 'places/edit/send/values',
    'places/view/messages', $checkFunction, $sendFunction);
