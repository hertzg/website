<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('..');

include_once '../fns/require_contact.php';
include_once '../../lib/mysqli.php';
list($contact, $id, $user) = require_contact($mysqli);

$errors = [];

include_once '../fns/request_contact_params.php';
list($full_name, $alias, $address, $email, $phone1,$phone2,
    $birthday_day, $birthday_month, $birthday_year,
    $birthday_time, $username, $timezone, $tags,
    $tag_names, $notes, $favorite) = request_contact_params($user, $errors);

include_once '../../fns/ItemList/itemQuery.php';
$itemQuery = ItemList\itemQuery($id);

$values = [
    'full_name' => $full_name,
    'alias' => $alias,
    'address' => $address,
    'email' => $email,
    'phone1' => $phone1,
    'phone2' => $phone2,
    'birthday_day' => $birthday_day,
    'birthday_month' => $birthday_month,
    'birthday_year' => $birthday_year,
    'birthday_time' => $birthday_time,
    'username' => $username,
    'timezone' => $timezone,
    'tags' => $tags,
    'notes' => $notes,
    'favorite' => $favorite,
];

$_SESSION['contacts/edit/values'] = $values;

include_once '../../fns/redirect.php';

if ($errors) {
    $_SESSION['contacts/edit/errors'] = $errors;
    redirect("./$itemQuery");
}

unset($_SESSION['contacts/edit/errors']);

include_once '../../fns/request_strings.php';
list($sendButton) = request_strings('sendButton');
if ($sendButton) {
    unset(
        $_SESSION['contacts/edit/send/errors'],
        $_SESSION['contacts/edit/send/messages'],
        $_SESSION['contacts/edit/send/values']
    );
    $_SESSION['contacts/edit/send/contact'] = $values;
    redirect("send/$itemQuery");
}

unset($_SESSION['contacts/edit/values']);

include_once '../../fns/Users/Contacts/edit.php';
Users\Contacts\edit($mysqli, $user, $contact, $full_name,
    $alias, $address, $email, $phone1, $phone2, $birthday_time,
    $username, $timezone, $tags, $tag_names, $notes, $favorite);

$_SESSION['contacts/view/messages'] = ['Changes have been saved.'];
redirect("../view/$itemQuery");
