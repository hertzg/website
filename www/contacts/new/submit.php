<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../../fns/require_user.php';
$user = require_user('../../');

include_once '../../lib/mysqli.php';

$errors = [];

include_once '../fns/request_contact_params.php';
list($full_name, $alias, $address, $email, $phone1, $phone2,
    $birthday_day, $birthday_month, $birthday_year, $birthday_time,
    $username, $timezone, $tags, $tag_names,
    $notes, $favorite) = request_contact_params($user, $errors);

include_once '../../fns/redirect.php';

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
    'birthday_time' => $birthday_time,
    'username' => $username,
    'timezone' => $timezone,
    'tags' => $tags,
    'favorite' => $favorite,
];

if ($errors) {
    $_SESSION['contacts/new/errors'] = $errors;
    include_once '../../fns/ItemList/pageQuery.php';
    redirect('./'.ItemList\pageQuery());
}

unset($_SESSION['contacts/new/errors']);

include_once '../../fns/request_strings.php';
list($sendButton) = request_strings('sendButton');
if ($sendButton !== '') {
    include_once '../../fns/ItemList/pageQuery.php';
    redirect('send/'.ItemList\pageQuery());
}

unset($_SESSION['contacts/new/values']);

include_once '../../fns/Users/Contacts/add.php';
$id = Users\Contacts\add($mysqli, $user, $full_name, $alias,
    $address, $email, $phone1, $phone2, $birthday_time, $username,
    $timezone, $tags, $tag_names, $favorite, null);

include_once '../../fns/Users/Birthdays/invalidateIfNeeded.php';
Users\Birthdays\invalidateIfNeeded($mysqli, $user, $birthday_time);

$_SESSION['contacts/view/messages'] = ['Contact has been saved.'];

include_once '../../fns/ItemList/itemQuery.php';
redirect('../view/'.ItemList\itemQuery($id));
