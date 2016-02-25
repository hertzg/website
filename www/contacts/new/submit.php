<?php

include_once '../../../lib/defaults.php';

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../../fns/require_user.php';
$user = require_user('../../');

include_once '../../lib/mysqli.php';

include_once '../fns/request_contact_params.php';
list($full_name, $alias, $address, $email1, $email1_label,
    $email2, $email2_label, $phone1, $phone1_label, $phone2,
    $phone2_label, $birthday_day, $birthday_month, $birthday_year,
    $birthday_time, $username, $timezone, $tags, $tag_names,
    $notes, $favorite) = request_contact_params($user, $errors, $focus);

$values = [
    'focus' => $focus,
    'full_name' => $full_name,
    'alias' => $alias,
    'address' => $address,
    'email1' => $email1,
    'email1_label' => $email1_label,
    'email2' => $email2,
    'email2_label' => $email2_label,
    'phone1' => $phone1,
    'phone1_label' => $phone1_label,
    'phone2' => $phone2,
    'phone2_label' => $phone2_label,
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

$_SESSION['contacts/new/values'] = $values;

include_once '../../fns/redirect.php';

if ($errors) {
    $_SESSION['contacts/new/errors'] = $errors;
    include_once '../../fns/ItemList/pageQuery.php';
    redirect('./'.ItemList\pageQuery());
}

unset($_SESSION['contacts/new/errors']);

include_once '../../fns/request_strings.php';
list($sendButton) = request_strings('sendButton');
if ($sendButton !== '') {
    $_SESSION['contacts/new/send/contact'] = $values;
    unset(
        $_SESSION['contacts/new/send/errors'],
        $_SESSION['contacts/new/send/messages'],
        $_SESSION['contacts/new/send/values']
    );
    include_once '../../fns/ItemList/pageQuery.php';
    redirect('send/'.ItemList\pageQuery());
}

unset($_SESSION['contacts/new/values']);

include_once '../../fns/Users/Contacts/add.php';
$id = Users\Contacts\add($mysqli, $user, $full_name,
    $alias, $address, $email1, $email1_label, $email2,
    $email2_label, $phone1, $phone1_label, $phone2,
    $phone2_label, $birthday_time, $username, $timezone,
    $tags, $tag_names, $notes, $favorite, null);

$_SESSION['contacts/view/messages'] = ['Contact has been saved.'];

include_once '../../fns/ItemList/itemQuery.php';
redirect('../view/'.ItemList\itemQuery($id));
