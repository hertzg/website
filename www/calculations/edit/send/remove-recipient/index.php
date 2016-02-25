<?php

include_once '../../../../../lib/defaults.php';

include_once 'fns/require_recipient.php';
include_once '../../../../lib/mysqli.php';
list($id, $username, $user, $recipients) = require_recipient($mysqli);

unset(
    $_SESSION['calculations/edit/send/errors'],
    $_SESSION['calculations/edit/send/messages']
);

include_once '../../../../fns/SendForm/EditItem/removeRecipientPage.php';
SendForm\EditItem\removeRecipientPage($mysqli,
    $user, $id, $username, 'calculation', $recipients);
