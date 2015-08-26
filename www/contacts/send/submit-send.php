<?php

$fnsDir = '../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('..');

include_once '../fns/require_contact.php';
include_once '../../lib/mysqli.php';
list($contact, $id, $user) = require_contact($mysqli);

$checkFunction = function ($recipients,
    &$receiver_id_userss, &$errors) use ($mysqli, $user) {

    include_once '../fns/check_receivers.php';
    check_receivers($mysqli, $user->id_users,
        $recipients, $receiver_id_userss, $errors);

};

$sendFunction = function ($receiver_id_userss) use (
    $mysqli, $contact, $user, $fnsDir) {

    include_once "$fnsDir/Users/Contacts/send.php";
    foreach ($receiver_id_userss as $receiver_id_users) {
        Users\Contacts\send($mysqli, $user, $receiver_id_users, $contact);
    }

};

include_once "$fnsDir/SendForm/submitSendPage.php";
SendForm\submitSendPage($user, $id, 'contacts/send/errors',
    'contacts/send/messages', 'contacts/send/values',
    'contacts/view/messages', $checkFunction, $sendFunction);
