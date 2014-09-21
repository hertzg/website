<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once 'fns/require_received_contact.php';
include_once '../../lib/mysqli.php';
list($receivedContact, $id, $user) = require_received_contact($mysqli);

include_once '../../fns/Users/Contacts/Received/archive.php';
Users\Contacts\Received\archive($mysqli, $receivedContact);

$_SESSION['contacts/received/view/messages'] = ['Contact has been archived.'];

include_once '../../fns/redirect.php';
redirect("view/?id=$id");