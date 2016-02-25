<?php

include_once '../../../lib/defaults.php';

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('..');

include_once '../fns/require_contact.php';
include_once '../../lib/mysqli.php';
list($contact, $id, $user) = require_contact($mysqli);

unset(
    $_SESSION['contacts/send/errors'],
    $_SESSION['contacts/send/messages']
);

include_once '../../fns/SendForm/submitCancelPage.php';
SendForm\submitCancelPage($id, 'contacts/send/values');
