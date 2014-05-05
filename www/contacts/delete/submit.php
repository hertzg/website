<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('..');

include_once '../fns/require_contact.php';
include_once '../../lib/mysqli.php';
list($contact, $id, $user) = require_contact($mysqli);

include_once '../../fns/Users/Contacts/delete.php';
Users\Contacts\delete($mysqli, $contact, $user);

unset($_SESSION['contacts/errors']);
$_SESSION['contacts/messages'] = ['Contact has been deleted.'];

include_once '../../fns/redirect.php';
redirect('..');
