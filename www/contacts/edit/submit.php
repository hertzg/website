<?php

include_once '../../../lib/defaults.php';

$fnsDir = '../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('..');

include_once '../fns/require_contact.php';
include_once '../../lib/mysqli.php';
list($contact, $id, $user) = require_contact($mysqli);

include_once '../fns/request_contact_params.php';
list($full_name, $alias, $address, $email1, $email1_label,
    $email2, $email2_label, $phone1, $phone1_label, $phone2,
    $phone2_label, $birthday_day, $birthday_month, $birthday_year,
    $birthday_time, $username, $timezone, $tags, $tag_names,
    $notes, $favorite) = request_contact_params($user, $errors, $focus);

include_once "$fnsDir/ItemList/itemQuery.php";
$itemQuery = ItemList\itemQuery($id);

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

$_SESSION['contacts/edit/values'] = $values;

include_once "$fnsDir/redirect.php";

if ($errors) {
    $_SESSION['contacts/edit/errors'] = $errors;
    redirect("./$itemQuery");
}

unset($_SESSION['contacts/edit/errors']);

include_once "$fnsDir/request_strings.php";
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

include_once "$fnsDir/Users/Contacts/edit.php";
Users\Contacts\edit($mysqli, $user, $contact, $full_name,
    $alias, $address, $email1, $email1_label, $email2,
    $email2_label, $phone1, $phone1_label, $phone2,
    $phone2_label, $birthday_time, $username, $timezone,
    $tags, $tag_names, $notes, $favorite, $changed);

if ($changed) $message = 'Changes have been saved.';
else $message = 'No changes to be saved.';
$_SESSION['contacts/view/messages'] = [$message];

redirect("../view/$itemQuery");
