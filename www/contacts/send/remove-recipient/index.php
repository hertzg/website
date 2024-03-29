<?php

include_once '../../../../lib/defaults.php';

include_once 'fns/require_recipient.php';
include_once '../../../lib/mysqli.php';
list($contact, $id, $username, $user, $recipients) = require_recipient($mysqli);

unset(
    $_SESSION['contacts/send/errors'],
    $_SESSION['contacts/send/messages']
);

include_once '../../../fns/SendForm/removeRecipientPage.php';
SendForm\removeRecipientPage($mysqli, $user, $id, $username,
    "Contact #$id", 'contact', $recipients, '../../../', '../../');
