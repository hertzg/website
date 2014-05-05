<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('..');

include_once '../fns/require_contact.php';
include_once '../../lib/mysqli.php';
list($contact, $id, $user) = require_contact($mysqli);
$id_users = $user->id_users;

$errors = [];

include_once '../fns/request_contact_params.php';
list($full_name, $alias, $address, $email, $phone1, $phone2, $birthday_day,
    $birthday_month, $birthday_year, $birthday_time, $username, $tags,
    $tag_names, $favorite) = request_contact_params($mysqli, $id_users, $errors, $id);

include_once '../../fns/ItemList/itemQuery.php';
$itemQuery = ItemList\itemQuery($id);

include_once '../../fns/redirect.php';

if ($errors) {
    $_SESSION['contacts/edit/errors'] = $errors;
    $_SESSION['contacts/edit/values'] = [
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
    redirect("./$itemQuery");
}

unset(
    $_SESSION['contacts/edit/errors'],
    $_SESSION['contacts/edit/values']
);

include_once '../../fns/Users/Contacts/edit.php';
Users\Contacts\edit($mysqli, $id_users, $id, $full_name, $alias, $address,
    $email, $phone1, $phone2, $birthday_time, $username, $tags, $tag_names, $favorite);

include_once '../../fns/Users/Birthdays/invalidateIfNeeded.php';
Users\Birthdays\invalidateIfNeeded($mysqli, $user, $contact->birthday_time);
Users\Birthdays\invalidateIfNeeded($mysqli, $user, $birthday_time);

$_SESSION['contacts/view/messages'] = ['Changes have been saved.'];
redirect("../view/$itemQuery");
