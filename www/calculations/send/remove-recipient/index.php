<?php

include_once '../../../../lib/defaults.php';

include_once 'fns/require_recipient.php';
include_once '../../../lib/mysqli.php';
$values = require_recipient($mysqli);
list($calculation, $id, $username, $user, $recipients) = $values;

unset(
    $_SESSION['calculations/send/errors'],
    $_SESSION['calculations/send/messages']
);

include_once '../../../fns/SendForm/removeRecipientPage.php';
SendForm\removeRecipientPage($mysqli, $user, $id,
    $username, "Calculation #$id", 'calculation', $recipients);
