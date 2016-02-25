<?php

include_once '../../../../lib/defaults.php';

include_once '../../../fns/require_same_domain_referer.php';
require_same_domain_referer('../..');

include_once 'fns/require_stage.php';
include_once '../../../lib/mysqli.php';
list($user, $stageValues, $id) = require_stage($mysqli);

$checkFunction = function ($username, &$errors) use ($mysqli, $user) {
    include_once '../../fns/check_receiver.php';
    check_receiver($mysqli, $user->id_users,
        $username, $receiver_id_users, $errors);
};

include_once '../../../fns/SendForm/EditItem/submitAddPage.php';
SendForm\EditItem\submitAddPage($mysqli, $user, $id,
    'schedules/edit/send/errors', 'schedules/edit/send/messages',
    'schedules/edit/send/values', $checkFunction);
