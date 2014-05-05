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

if ($username === '') {
    $errors[] = 'Enter username.';
} else {
    include_once '../../fns/Users/getByUsername.php';
    $receiverUser = Users\getByUsername($mysqli, $username);
    if (!$receiverUser) {
        $errors[] = "A user with the username doesn't exist.";
    } else {
        $receiver_id_users = $receiverUser->id_users;
        if ($receiver_id_users == $id_users) {
            $errors[] = 'You cannot send a contact to yourself.';
        } else {
            include_once '../../fns/get_users_connection.php';
            $connection = get_users_connection($mysqli, $receiverUser, $id_users);
            if (!$connection['can_send_contact']) {
                $errors[] = "The user isn't receiving contacts from you.";
            }
        }
    }
}

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
