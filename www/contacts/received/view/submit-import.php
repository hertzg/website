<?php

include_once '../../../fns/require_same_domain_referer.php';
require_same_domain_referer('..');

include_once '../fns/require_received_contact.php';
include_once '../../../lib/mysqli.php';
list($receivedContact, $id, $user) = require_received_contact($mysqli);
$id_users = $user->id_users;

$full_name = $receivedContact->full_name;
$alias = $receivedContact->alias;
$tags = $receivedContact->tags;
$favorite = $receivedContact->favorite;

include_once '../../../fns/Tags/parse.php';
$tag_names = Tags\parse($tags);

include_once '../../../fns/Contacts/add.php';
$id_contacts = Contacts\add($mysqli, $id_users, $full_name, $alias,
    $receivedContact->address, $receivedContact->email,
    $receivedContact->phone1, $receivedContact->phone2,
    $receivedContact->username, $tags, $favorite);

include_once '../../../fns/ContactTags/add.php';
ContactTags\add($mysqli, $id_users, $id_contacts,
    $tag_names, $full_name, $alias, $favorite);

include_once '../../../fns/Users/addNumContacts.php';
Users\addNumContacts($mysqli, $id_users, 1);

include_once '../../../fns/ReceivedContacts/delete.php';
ReceivedContacts\delete($mysqli, $id);

include_once '../../../fns/Users/addNumReceivedContacts.php';
Users\addNumReceivedContacts($mysqli, $id_users, -1);

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
