<?php

include_once '../../../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../fns/require_received_contacts.php';
$user = require_received_contacts('../');
$id_users = $user->id_users;

include_once '../../../fns/ReceivedContacts/deleteOnReceiver.php';
include_once '../../../lib/mysqli.php';
ReceivedContacts\deleteOnReceiver($mysqli, $id_users);

include_once '../../../fns/Users/clearNumReceivedContacts.php';
Users\clearNumReceivedContacts($mysqli, $id_users);

unset($_SESSION['contacts/errors']);
$_SESSION['contacts/messages'] = [
    'All received contacts have been deleted.',
];

include_once '../../../fns/redirect.php';
redirect('../..');
