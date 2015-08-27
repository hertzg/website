<?php

$fnsDir = '../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('..');

include_once '../fns/require_note.php';
include_once '../../lib/mysqli.php';
list($note, $id, $user) = require_note($mysqli);

$checkFunction = function ($recipients,
    &$receiver_id_userss, &$errors) use ($mysqli, $user) {

    include_once '../fns/check_receivers.php';
    check_receivers($mysqli, $user->id_users,
        $recipients, $receiver_id_userss, $errors);

};

$sendFunction = function ($receiver_id_userss) use (
    $mysqli, $note, $user, $fnsDir) {

    include_once "$fnsDir/Users/Notes/send.php";
    foreach ($receiver_id_userss as $receiver_id_users) {
        Users\Notes\send($mysqli, $user, $receiver_id_users, $note);
    }

};

include_once "$fnsDir/SendForm/submitSendPage.php";
SendForm\submitSendPage($user, $id, 'notes/send/errors',
    'notes/send/messages', 'notes/send/values',
    'notes/view/messages', $checkFunction, $sendFunction);
