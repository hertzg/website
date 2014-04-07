<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../../fns/require_user.php';
$user = require_user('../../');
$id_users = $user->id_users;

include_once '../../lib/mysqli.php';

include_once '../../fns/request_strings.php';
list($full_name, $alias, $address, $email, $phone1,
    $phone2, $birth_day, $birth_month, $birth_year,
    $username, $tags, $favorite) = request_strings(
    'full_name', 'alias', 'address', 'email', 'phone1',
    'phone2', 'birth_day', 'birth_month', 'birth_year',
    'username', 'tags', 'favorite');

include_once '../../fns/str_collapse_spaces.php';
$full_name = str_collapse_spaces($full_name);
$alias = str_collapse_spaces($alias);
$address = str_collapse_spaces($address);
$email = str_collapse_spaces($email);
$phone1 = str_collapse_spaces($phone1);
$phone2 = str_collapse_spaces($phone2);
$username = str_collapse_spaces($username);
$tags = str_collapse_spaces($tags);

$birth_day = abs((int)$birth_day);
$birth_month = abs((int)$birth_month);
$birth_year = abs((int)$birth_year);

$favorite = (bool)$favorite;

$errors = [];

if ($full_name === '') {
    $errors[] = 'Enter full name.';
} elseif (mb_strlen($full_name, 'UTF-8') > 32) {
    $errors[] = 'Full name too long. At most 32 characters required.';
} else {
    include_once '../../fns/Contacts/getByFullName.php';
    if (Contacts\getByFullName($mysqli, $id_users, $full_name)) {
        $errors[] = 'A contact with this name already exists.';
    }
}

include_once '../fns/parse_birth_date.php';
parse_birth_date($birth_day, $birth_month, $birth_year, $errors, $birth_time);

include_once '../../fns/parse_tags.php';
parse_tags($tags, $tag_names, $errors);

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
        'birth_day' => $birth_day,
        'birth_month' => $birth_month,
        'birth_year' => $birth_year,
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
    $email, $phone1, $phone2, $birth_time, $username, $tags, $favorite);

include_once '../../fns/ContactTags/add.php';
ContactTags\add($mysqli, $id_users, $id,
    $tag_names, $full_name, $alias, $favorite);

include_once '../../fns/Users/addNumContacts.php';
Users\addNumContacts($mysqli, $id_users, 1);

$_SESSION['contacts/view/messages'] = ['Contact has been saved.'];
redirect("../view/?id=$id");
