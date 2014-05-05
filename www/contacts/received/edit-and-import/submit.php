<?php

include_once '../../../fns/require_same_domain_referer.php';
require_same_domain_referer('..');

include_once '../fns/require_received_contact.php';
include_once '../../../lib/mysqli.php';
list($receivedContact, $id, $user) = require_received_contact($mysqli);
$id_users = $user->id_users;

$errors = [];

include_once '../../fns/request_contact_params.php';
list($full_name, $alias, $address, $email, $phone1, $phone2, $birthday_day,
    $birthday_month, $birthday_year, $birthday_time, $username, $tags,
    $tag_names, $favorite) = request_contact_params($mysqli, $id_users, $errors);

include_once '../../../fns/redirect.php';

if ($errors) {
    $_SESSION['contacts/received/edit-and-import/errors'] = $errors;
    $_SESSION['contacts/received/edit-and-import/values'] = [
        'full_name' => $full_name,
        'alias' => $alias,
        'address' => $address,
        'email' => $email,
        'phone1' => $phone1,
        'phone2' => $phone2,
        'birthday_day' => $birthday_day,
        'birthday_month' => $birthday_month,
        'birthday_year' => $birthday_year,
        'username' => $username,
        'tags' => $tags,
        'favorite' => $favorite,
    ];
    redirect("./?id=$id");
}

unset(
    $_SESSION['contacts/received/edit-and-import/errors'],
    $_SESSION['contacts/received/edit-and-import/values']
);

include_once '../../../fns/Contacts/add.php';
$id_contacts = Contacts\add($mysqli, $id_users, $full_name, $alias, $address,
    $email, $phone1, $phone2, $birthday_time, $username, $tags, $favorite);

include_once '../../../fns/ContactTags/add.php';
ContactTags\add($mysqli, $id_users, $id_contacts,
    $tag_names, $full_name, $alias, $favorite);

include_once '../../../fns/ReceivedContacts/delete.php';
ReceivedContacts\delete($mysqli, $id);

include_once '../../../fns/Users/Contacts/Received/addNumber.php';
Users\Contacts\Received\addNumber($mysqli, $id_users, -1);

include_once '../../../fns/Users/Birthdays/invalidateIfNeeded.php';
Users\Birthdays\invalidateIfNeeded($mysqli, $user, $birthday_time);

$messages = ['Contact has been imported.'];

if ($user->num_received_contacts == 1) {
    $messages[] = 'No more received contacts.';
    $_SESSION['contacts/messages'] = $messages;
    unset($_SESSION['contacts/errors']);
    redirect('../..');
}

$_SESSION['contacts/received/messages'] = $messages;
redirect('..');
