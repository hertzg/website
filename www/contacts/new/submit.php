<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../../fns/require_user.php';
$user = require_user('../../');
$id_users = $user->id_users;

include_once '../../lib/mysqli.php';

$errors = [];

include_once '../fns/request_contact_params.php';
list($full_name, $alias, $address, $email, $phone1, $phone2, $birthday_day,
    $birthday_month, $birthday_year, $birthday_time, $username, $tags,
    $tag_names, $favorite) = request_contact_params($mysqli, $id_users, $errors);

include_once '../../fns/redirect.php';

if ($errors) {
    $_SESSION['contacts/new/errors'] = $errors;
    $_SESSION['contacts/new/values'] = [
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
    redirect();
}

unset(
    $_SESSION['contacts/new/errors'],
    $_SESSION['contacts/new/values']
);

include_once '../../fns/Contacts/add.php';
$id = Contacts\add($mysqli, $id_users, $full_name, $alias, $address,
    $email, $phone1, $phone2, $birthday_time, $username, $tags, $favorite);

include_once '../../fns/ContactTags/add.php';
ContactTags\add($mysqli, $id_users, $id,
    $tag_names, $full_name, $alias, $favorite);

include_once '../fns/invalidate_user_birthdays.php';
invalidate_user_birthdays($mysqli, $user, $birthday_time);

$_SESSION['contacts/view/messages'] = ['Contact has been saved.'];
redirect("../view/?id=$id");
