<?php

include_once 'fns/require_recipient.php';
include_once '../../../lib/mysqli.php';
list($contact, $id, $username, $user) = require_recipient($mysqli);

unset($_SESSION['contacts/send/errors']);

include_once '../../../fns/SendForm/submitRemovePage.php';
SendForm\submitRemovePage($id, $username,
    'contacts/send/messages', 'contacts/send/values');
