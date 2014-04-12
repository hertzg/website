<?php

include_once '../../../fns/require_same_domain_referer.php';
require_same_domain_referer('../..');

include_once '../fns/require_received_contact.php';
include_once '../../../lib/mysqli.php';
list($receivedContact, $id, $user) = require_received_contact($mysqli);

include_once '../../../fns/ReceivedContacts/delete.php';
ReceivedContacts\delete($mysqli, $id);

include_once '../../../fns/Users/addNumReceivedContacts.php';
Users\addNumReceivedContacts($mysqli, $user->id_users, -1);

$messages = ['Contact has been deleted.'];
include_once '../../../fns/redirect.php';

if ($user->num_received_contacts == 1) {
    $messages[] = 'No more received contacts.';
    $_SESSION['contacts/messages'] = $messages;
    unset($_SESSION['contacts/errors']);
    redirect('../..');
}

$_SESSION['contacts/received/messages'] = $messages;
redirect('..');
