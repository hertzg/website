<?php

include_once '../../../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once 'fns/require_stage.php';
list($user) = require_stage();

include_once '../../../lib/mysqli.php';
$checkFunction = function ($username, &$errors) use ($mysqli, $user) {
    include_once '../../fns/check_receiver.php';
    check_receiver($mysqli, $user->id_users,
        $username, $receiver_id_users, $errors);
};

include_once '../../../fns/SendForm/NewItem/submitAddPage.php';
SendForm\NewItem\submitAddPage($mysqli, $user, 'calculations/new/send/errors',
    'calculations/new/send/messages', 'calculations/new/send/values', $checkFunction);
