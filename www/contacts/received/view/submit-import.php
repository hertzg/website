<?php

include_once '../../../fns/require_same_domain_referer.php';
require_same_domain_referer('..');

include_once '../fns/require_received_contact.php';
include_once '../../../lib/mysqli.php';
list($receivedContact, $id, $user) = require_received_contact($mysqli);

$tags = $receivedContact->tags;

include_once '../../../fns/Tags/parse.php';
$tag_names = Tags\parse($tags);

include_once '../../../fns/Users/Contacts/add.php';
Users\Contacts\add($mysqli, $user, $receivedContact->full_name,
    $receivedContact->alias, $receivedContact->address, $receivedContact->email,
    $receivedContact->phone1, $receivedContact->phone2,
    $receivedContact->birthday_time, $receivedContact->username, $tags,
    $tag_names, $receivedContact->favorite);

include_once '../../../fns/Users/Contacts/Received/delete.php';
Users\Contacts\Received\delete($mysqli, $receivedContact);

$messages = ['Contact has been imported.'];

include_once '../../../fns/redirect.php';

if ($user->num_received_contacts == 1) {
    $messages[] = 'No more received contacts.';
    $_SESSION['contacts/messages'] = $messages;
    unset($_SESSION['contacts/errors']);
    redirect('../..');
}

$_SESSION['contacts/received/messages'] = $messages;

redirect('..');
