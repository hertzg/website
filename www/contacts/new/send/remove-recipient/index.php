<?php

include_once '../../../../../lib/defaults.php';

include_once 'fns/require_recipient.php';
list($username, $user, $recipients) = require_recipient();

unset(
    $_SESSION['contacts/new/send/errors'],
    $_SESSION['contacts/new/send/messages']
);

include_once '../../../../fns/SendForm/NewItem/removeRecipientPage.php';
include_once '../../../../lib/mysqli.php';
SendForm\NewItem\removeRecipientPage($mysqli, $user, $username,
    'Contact', 'contact', $recipients, '../../../../', '../../../');
