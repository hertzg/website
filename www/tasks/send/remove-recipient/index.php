<?php

include_once '../../../../lib/defaults.php';

include_once 'fns/require_recipient.php';
include_once '../../../lib/mysqli.php';
list($task, $id, $username, $user, $recipients) = require_recipient($mysqli);

unset(
    $_SESSION['tasks/send/errors'],
    $_SESSION['tasks/send/messages']
);

include_once '../../../fns/SendForm/removeRecipientPage.php';
SendForm\removeRecipientPage($mysqli, $user, $id,
    $username, "Task #$id", 'task', $recipients);
