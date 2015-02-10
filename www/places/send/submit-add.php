<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('..');

include_once '../fns/require_place.php';
include_once '../../lib/mysqli.php';
list($place, $id, $user) = require_place($mysqli);

$checkFunction = function ($username, &$errors) use ($mysqli, $user) {
    include_once '../fns/check_receiver.php';
    check_receiver($mysqli, $user->id_users,
        $username, $receiver_id_users, $errors);
};

include_once '../../fns/SendForm/submitAddPage.php';
SendForm\submitAddPage($user, $id, 'places/send/errors',
    'places/send/messages', 'places/send/values', $checkFunction);
