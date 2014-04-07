<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('..');

include_once '../fns/require_contact.php';
include_once '../../lib/mysqli.php';
list($contact, $id, $user) = require_contact($mysqli);
$id_users = $user->id_users;

include_once '../../fns/request_strings.php';
list($full_name, $alias, $address, $email, $phone1, $phone2, $birthday_day,
    $birthday_month, $birthday_year, $username, $tags) = request_strings(
    'full_name', 'alias', 'address', 'email', 'phone1', 'phone2', 'birthday_day',
    'birthday_month', 'birthday_year', 'username', 'tags');

include_once '../../fns/str_collapse_spaces.php';
$full_name = str_collapse_spaces($full_name);
$alias = str_collapse_spaces($alias);
$address = str_collapse_spaces($address);
$email = str_collapse_spaces($email);
$phone1 = str_collapse_spaces($phone1);
$phone2 = str_collapse_spaces($phone2);
$username = str_collapse_spaces($username);
$tags = str_collapse_spaces($tags);

$birthday_day = abs((int)$birthday_day);
$birthday_month = abs((int)$birthday_month);
$birthday_year = abs((int)$birthday_year);

$errors = [];

if ($full_name === '') {
    $errors[] = 'Enter full name.';
} elseif (mb_strlen($full_name, 'UTF-8') > 32) {
    $errors[] = 'Full name too long. At most 32 characters required.';
} else {
    include_once '../../fns/Contacts/getByFullName.php';
    if (Contacts\getByFullName($mysqli, $id_users, $full_name, $id)) {
        $errors[] = 'A contact with this name already exists.';
    }
}

include_once '../fns/parse_birthday.php';
parse_birthday($birthday_day, $birthday_month, $birthday_year, $errors, $birthday_time);

include_once '../../fns/parse_tags.php';
parse_tags($tags, $tag_names, $errors);

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
    ];
    redirect("./$itemQuery");
}

unset(
    $_SESSION['contacts/edit/errors'],
    $_SESSION['contacts/edit/values']
);

include_once '../../fns/Contacts/edit.php';
Contacts\edit($mysqli, $id_users, $id, $full_name, $alias, $address,
    $email, $phone1, $phone2, $birthday_time, $username, $tags);

include_once '../../fns/ContactTags/deleteOnContact.php';
ContactTags\deleteOnContact($mysqli, $id);

include_once '../../fns/ContactTags/add.php';
ContactTags\add($mysqli, $id_users, $id,
    $tag_names, $full_name, $alias, $contact->favorite);

include_once '../fns/invalidate_user_birthdays.php';
invalidate_user_birthdays($mysqli, $user, $contact->birthday_time);
invalidate_user_birthdays($mysqli, $user, $birthday_time);

$_SESSION['contacts/view/messages'] = ['Changes have been saved.'];
redirect("../view/$itemQuery");
