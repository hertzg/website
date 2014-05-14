<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../fns/require_contact.php';
include_once '../../lib/mysqli.php';
list($contact, $id, $user) = require_contact($mysqli);
$id_users = $user->id_users;

include_once '../../fns/request_strings.php';
list($username) = request_strings('username');

$errors = [];

include_once '../fns/check_receiver.php';
check_receiver($mysqli, $id_users, $username, $receiver_id_users, $errors);

include_once '../../fns/ItemList/itemQuery.php';
$itemQuery = ItemList\itemQuery($id);

include_once '../../fns/redirect.php';

if ($errors) {
    $_SESSION['contacts/send/errors'] = $errors;
    $_SESSION['contacts/send/values'] = ['username' => $username];
    redirect("./$itemQuery");
}

unset(
    $_SESSION['contacts/send/errors'],
    $_SESSION['contacts/send/values']
);

include_once '../../fns/ReceivedContacts/add.php';
ReceivedContacts\add($mysqli, $id_users, $user->username, $receiver_id_users,
    $contact->full_name, $contact->alias, $contact->address, $contact->email,
    $contact->phone1, $contact->phone2, $contact->birthday_time,
    $contact->username, $contact->tags, $contact->favorite);

include_once '../../fns/Users/Contacts/Received/addNumber.php';
Users\Contacts\Received\addNumber($mysqli, $receiver_id_users, 1);

$_SESSION['contacts/view/messages'] = ['Sent.'];

redirect("../view/$itemQuery");
