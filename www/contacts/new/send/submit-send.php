<?php

include_once '../../../fns/require_same_domain_referer.php';
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

$sendFunction = function ($receiver_id_userss) use ($mysqli,
    $stageValues, $user) {

    include_once '../../../fns/Users/Contacts/Received/add.php';
    foreach ($receiver_id_userss as $receiver_id_users) {
        Users\Contacts\Received\add($mysqli, $user->id_users, $user->username,
            $receiver_id_users, $stageValues['full_name'],
            $stageValues['alias'], $stageValues['address'],
            $stageValues['email'], $stageValues['phone1'],
            $stageValues['phone2'], $stageValues['birthday_time'],
            $stageValues['username'], $stageValues['tags'],
            $stageValues['favorite']);
    }

};

include_once '../../../fns/SendForm/NewItem/submitSendPage.php';
SendForm\NewItem\submitSendPage($user, 'contacts/new/send/errors',
    'contacts/new/send/messages', 'contacts/new/send/values',
    'contacts/messages', $checkFunction, $sendFunction);
