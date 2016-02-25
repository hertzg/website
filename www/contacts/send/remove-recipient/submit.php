<?php

include_once '../../../../lib/defaults.php';

include_once '../../../fns/require_same_domain_referer.php';
require_same_domain_referer('../..');

include_once 'fns/require_recipient.php';
include_once '../../../lib/mysqli.php';
list($contact, $id, $username, $user) = require_recipient($mysqli);

unset($_SESSION['contacts/send/errors']);

include_once '../../../fns/SendForm/submitRemovePage.php';
SendForm\submitRemovePage($id, $username,
    'contacts/send/messages', 'contacts/send/values');
