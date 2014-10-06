<?php

include_once '../fns/require_contact.php';
include_once '../../lib/mysqli.php';
list($contact, $id, $user) = require_contact($mysqli);

$key = 'contacts/edit/values';
if (array_key_exists($key, $_SESSION)) {
    $values = $_SESSION[$key];
} else {

    $birthday_time = $contact->birthday_time;
    if ($birthday_time === null) {
        $birthday_day = $birthday_month = $birthday_year = 0;
    } else {
        $birthday_day = date('d', $birthday_time);
        $birthday_month = date('n', $birthday_time);
        $birthday_year = date('Y', $birthday_time);
    }

    $values = [
        'full_name' => $contact->full_name,
        'alias' => $contact->alias,
        'address' => $contact->address,
        'email' => $contact->email,
        'phone1' => $contact->phone1,
        'phone2' => $contact->phone2,
        'birthday_day' => $birthday_day,
        'birthday_month' => $birthday_month,
        'birthday_year' => $birthday_year,
        'birthday_time' => $birthday_time,
        'username' => $contact->username,
        'timezone' => $contact->timezone,
        'tags' => $contact->tags,
        'notes' => $contact->notes,
        'favorite' => $contact->favorite,
    ];

}

unset(
    $_SESSION['contacts/edit/send/errors'],
    $_SESSION['contacts/edit/send/messages'],
    $_SESSION['contacts/edit/send/values'],
    $_SESSION['contacts/view/messages']
);

include_once 'fns/create_content.php';
$content = create_content($id, $values);

include_once '../../fns/echo_page.php';
echo_page($user, "Edit Contact #$id", $content, '../../');
