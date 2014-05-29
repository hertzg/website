<?php

include_once '../../../fns/require_same_domain_referer.php';
require_same_domain_referer('..');

include_once '../fns/require_received_contact.php';
include_once '../../../lib/mysqli.php';
list($receivedContact, $id, $user) = require_received_contact($mysqli);

include_once '../../../fns/Users/Contacts/Received/unarchive.php';
Users\Contacts\Received\unarchive($mysqli, $receivedContact);

$_SESSION['contacts/received/view/messages'] = ['Contact has been unarchived.'];

include_once '../../../fns/redirect.php';
redirect("./?id=$id");
