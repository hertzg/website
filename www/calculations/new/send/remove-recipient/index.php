<?php

include_once 'fns/require_recipient.php';
list($username, $user, $recipients) = require_recipient();

unset(
    $_SESSION['calculations/new/send/errors'],
    $_SESSION['calculations/new/send/messages']
);

include_once '../../../../fns/SendForm/NewItem/removeRecipientPage.php';
include_once '../../../../lib/mysqli.php';
SendForm\NewItem\removeRecipientPage($mysqli,
    $user, $username, 'Calculation', 'calculation', $recipients);