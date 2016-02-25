<?php

include_once '../../../../lib/defaults.php';

include_once 'fns/require_recipient.php';
include_once '../../../lib/mysqli.php';
$values = require_recipient($mysqli);
list($schedule, $id, $username, $user, $recipients) = $values;

unset(
    $_SESSION['schedules/send/errors'],
    $_SESSION['schedules/send/messages']
);

include_once '../../../fns/SendForm/removeRecipientPage.php';
SendForm\removeRecipientPage($mysqli, $user, $id,
    $username, "Schedule #$id", 'schedule', $recipients);
