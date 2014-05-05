<?php

include_once '../../../fns/require_same_domain_referer.php';
require_same_domain_referer('..');

include_once '../fns/require_received_contact.php';
include_once '../../../lib/mysqli.php';
list($receivedContact, $id, $user) = require_received_contact($mysqli);
$id_users = $user->id_users;

$full_name = $receivedContact->full_name;
$alias = $receivedContact->alias;
$address = $receivedContact->address;
$email = $receivedContact->email;
$phone1 = $receivedContact->phone1;
$phone2 = $receivedContact->phone2;
$birthday_time = $receivedContact->birthday_time;
$username = $receivedContact->username;
$tags = $receivedContact->tags;
$favorite = $receivedContact->favorite;

include_once '../../../fns/redirect.php';

include_once '../../../fns/Contacts/getByFullName.php';
if (Contacts\getByFullName($mysqli, $id_users, $full_name)) {
    $_SESSION['contacts/received/edit-and-import/errors'] = [
        'A contact with this name already exists.',
    ];
    $_SESSION['contacts/received/edit-and-import/values'] = [
        'full_name' => $full_name,
        'alias' => $alias,
        'address' => $address,
        'email' => $email,
        'phone1' => $phone1,
        'phone2' => $phone2,
        'birthday_day' => date('d', $birthday_time),
        'birthday_month' => date('n', $birthday_time),
        'birthday_year' => date('Y', $birthday_time),
        'username' => $username,
        'tags' => $tags,
        'favorite' => $favorite,
    ];
    redirect("../edit-and-import/?id=$id");
}

unset(
    $_SESSION['contacts/received/edit-and-import/errors'],
    $_SESSION['contacts/received/edit-and-import/values']
);

include_once '../../../fns/Tags/parse.php';
$tag_names = Tags\parse($tags);

include_once '../../../fns/Users/Contacts/add.php';
Users\Contacts\add($mysqli, $user, $full_name, $alias, $address, $email,
    $phone1, $phone2, $birthday_time, $username, $tags, $tag_names, $favorite);

include_once '../../../fns/ReceivedContacts/delete.php';
ReceivedContacts\delete($mysqli, $id);

include_once '../../../fns/Users/Contacts/Received/addNumber.php';
Users\Contacts\Received\addNumber($mysqli, $id_users, -1);

$messages = ['Contact has been imported.'];

if ($user->num_received_contacts == 1) {
    $messages[] = 'No more received contacts.';
    $_SESSION['contacts/messages'] = $messages;
    unset($_SESSION['contacts/errors']);
    redirect('../..');
}

$_SESSION['contacts/received/messages'] = $messages;

redirect('..');
