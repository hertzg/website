<?php

$fnsDir = '../../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('../..');

include_once '../fns/require_received_contact.php';
include_once '../../../lib/mysqli.php';
list($receivedContact, $id, $user) = require_received_contact($mysqli, '../');

include_once "$fnsDir/Users/Contacts/Received/delete.php";
Users\Contacts\Received\delete($mysqli, $receivedContact);

$messages = ["Received contact #$id has been deleted."];
include_once "$fnsDir/redirect.php";

if ($user->num_received_contacts == 1) {
    $messages[] = 'No more received contacts.';
    $_SESSION['contacts/messages'] = $messages;
    unset($_SESSION['contacts/errors']);
    redirect('../..');
}

unset($_SESSION['contacts/received/errors']);
$_SESSION['contacts/received/messages'] = $messages;

include_once "$fnsDir/ItemList/Received/listUrl.php";
redirect(ItemList\Received\listUrl('../'));
