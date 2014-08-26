<?php

include_once 'fns/require_recipient.php';
include_once '../../../lib/mysqli.php';
list($note, $id, $username, $user) = require_recipient($mysqli);

unset(
    $_SESSION['notes/send/errors'],
    $_SESSION['notes/send/messages']
);

include_once '../../../fns/SendForm/removeRecipientPage.php';
SendForm\removeRecipientPage($user, $id, $username, "Note #$id");
