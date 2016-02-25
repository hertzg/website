<?php

include_once '../../../lib/defaults.php';

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('..');

include_once '../fns/require_task.php';
include_once '../../lib/mysqli.php';
list($task, $id, $user) = require_task($mysqli);

$checkFunction = function ($username, &$errors) use ($mysqli, $user) {
    include_once '../fns/check_receiver.php';
    check_receiver($mysqli, $user->id_users,
        $username, $receiver_id_users, $errors);
};

include_once '../../fns/SendForm/submitAddPage.php';
SendForm\submitAddPage($mysqli, $user, $id, 'tasks/send/errors',
    'tasks/send/messages', 'tasks/send/values', $checkFunction);
