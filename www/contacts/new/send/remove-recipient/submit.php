<?php

include_once 'fns/require_recipient.php';
list($username, $user) = require_recipient();

unset($_SESSION['contacts/new/send/errors']);

include_once '../../../../fns/SendForm/NewItem/submitRemovePage.php';
SendForm\NewItem\submitRemovePage($username,
    'contacts/new/send/messages', 'contacts/new/send/values');
