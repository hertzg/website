<?php

function require_recipient ($mysqli) {

    include_once __DIR__.'/../../../fns/require_schedule.php';
    list($schedule, $id, $user) = require_schedule($mysqli, '../');

    include_once __DIR__.'/../../../../fns/SendForm/requireRecipient.php';
    $values = SendForm\requireRecipient($id, 'schedules/send/values');
    list($username, $recipients) = $values;

    return [$schedule, $id, $username, $user, $recipients];

}
