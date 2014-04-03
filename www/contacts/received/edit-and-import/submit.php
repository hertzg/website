<?php

include_once '../fns/require_received_contact.php';
include_once '../../../lib/mysqli.php';
list($receivedContact, $id, $user) = require_received_contact($mysqli);
$id_users = $user->id_users;

include_once '../../../fns/request_strings.php';
list($full_name, $alias, $address, $email,
    $phone1, $phone2, $username, $tags) = request_strings(
    'full_name', 'alias', 'address', 'email',
    'phone1', 'phone2', 'username', 'tags');

include_once '../../../fns/str_collapse_spaces.php';
$full_name = str_collapse_spaces($full_name);
$alias = str_collapse_spaces($alias);
$address = str_collapse_spaces($address);
$email = str_collapse_spaces($email);
$phone1 = str_collapse_spaces($phone1);
$phone2 = str_collapse_spaces($phone2);
$username = str_collapse_spaces($username);
$tags = str_collapse_spaces($tags);

$errors = [];

if ($full_name === '') {
    $errors[] = 'Enter full name.';
} elseif (mb_strlen($full_name, 'UTF-8') > 32) {
    $errors[] = 'Full name too long. At most 32 characters required.';
} else {
    include_once '../../../fns/Contacts/getByFullName.php';
    if (Contacts\getByFullName($mysqli, $id_users, $full_name)) {
        $errors[] = 'A contact with this name already exists.';
    }
}

include_once '../../../fns/parse_tags.php';
parse_tags($tags, $tag_names, $errors);

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
        'username' => $username,
        'tags' => $tags,
    ];
    redirect("./?id=$id");
}

include_once '../../../fns/Contacts/add.php';
$id_contacts = Contacts\add($mysqli, $id_users, $full_name, $alias,
    $address, $email, $phone1, $phone2, $username, $tags);

include_once '../../../fns/ContactTags/add.php';
ContactTags\add($mysqli, $id_users, $id_contacts,
    $tag_names, $full_name, $alias);

include_once '../../../fns/Users/addNumContacts.php';
Users\addNumContacts($mysqli, $id_users, 1);

include_once '../../../fns/ReceivedContacts/delete.php';
ReceivedContacts\delete($mysqli, $id);

include_once '../../../fns/Users/addNumReceivedContacts.php';
Users\addNumReceivedContacts($mysqli, $id_users, -1);

$messages = ['Contact has been imported.'];

if ($user->num_received_contacts == 1) {
    $messages[] = 'No more received contacts.';
    $_SESSION['contacts/messages'] = $messages;
    unset($_SESSION['contacts/errors']);
    redirect('../..');
}

$_SESSION['contacts/received/messages'] = $messages;
redirect('..');
