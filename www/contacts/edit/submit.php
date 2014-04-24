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

include_once '../../fns/Contacts/edit.php';
Contacts\edit($mysqli, $id_users, $id, $full_name, $alias, $address,
    $email, $phone1, $phone2, $birthday_time, $username, $tags, $favorite);

include_once '../../fns/ContactTags/deleteOnContact.php';
ContactTags\deleteOnContact($mysqli, $id);

include_once '../../fns/ContactTags/add.php';
ContactTags\add($mysqli, $id_users, $id,
    $tag_names, $full_name, $alias, $favorite);

include_once '../fns/invalidate_user_birthdays.php';
invalidate_user_birthdays($mysqli, $user, $contact->birthday_time);
invalidate_user_birthdays($mysqli, $user, $birthday_time);

$_SESSION['contacts/view/messages'] = ['Changes have been saved.'];
redirect("../view/$itemQuery");
