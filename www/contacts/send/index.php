<?php

include_once '../../../lib/defaults.php';

include_once '../fns/require_contact.php';
include_once '../../lib/mysqli.php';
list($contact, $id, $user) = require_contact($mysqli);

unset($_SESSION['contacts/view/messages']);

include_once '../../fns/SendForm/recipientsPage.php';
SendForm\recipientsPage($mysqli, $user, $id, "Contact #$id",
    "Send Contact #$id", 'contact', 'contacts/send/errors',
    'contacts/send/messages', 'contacts/send/values');
