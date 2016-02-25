<?php

include_once '../../../../lib/defaults.php';

include_once 'fns/require_recipient.php';
include_once '../../../lib/mysqli.php';
list($place, $id, $username, $user, $recipients) = require_recipient($mysqli);

unset(
    $_SESSION['places/send/errors'],
    $_SESSION['places/send/messages']
);

include_once '../../../fns/SendForm/removeRecipientPage.php';
SendForm\removeRecipientPage($mysqli, $user, $id,
    $username, "Place #$id", 'place', $recipients);
