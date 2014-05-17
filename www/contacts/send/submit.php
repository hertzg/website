<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../fns/require_contact.php';
include_once '../../lib/mysqli.php';
list($contact, $id, $user) = require_contact($mysqli);

include_once '../../fns/request_strings.php';
list($username) = request_strings('username');

$errors = [];

include_once '../fns/check_receiver.php';
check_receiver($mysqli, $user->id_users,
    $username, $receiver_id_users, $errors);

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

include_once '../../fns/Users/Contacts/send.php';
Users\Contacts\send($mysqli, $user, $receiver_id_users, $contact);

$_SESSION['contacts/view/messages'] = ['Sent.'];

redirect("../view/$itemQuery");
