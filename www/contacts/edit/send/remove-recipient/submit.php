<?php

include_once '../../../../fns/require_same_domain_referer.php';
require_same_domain_referer('../../..');

include_once 'fns/require_recipient.php';
include_once '../../../../lib/mysqli.php';
list($id, $username, $user) = require_recipient($mysqli);

unset($_SESSION['contacts/edit/send/errors']);

include_once '../../../../fns/SendForm/EditItem/submitRemovePage.php';
SendForm\EditItem\submitRemovePage($id, $username,
    'contacts/edit/send/messages', 'contacts/edit/send/values');
