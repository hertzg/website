<?php

include_once '../fns/require_received_contact.php';
include_once '../../../lib/mysqli.php';
list($receivedContact, $id, $user) = require_received_contact($mysqli);

unset($_SESSION['contacts/received/view/messages']);

$key = 'contacts/received/edit-and-import/values';
if (array_key_exists($key, $_SESSION)) {
    $values = $_SESSION[$key];
} else {

    $birthday_time = $receivedContact->birthday_time;
    if ($birthday_time === null) {
        $birthday_day = $birthday_month = $birthday_year = 0;
    } else {
        $birthday_day = date('d', $birthday_time);
        $birthday_month = date('n', $birthday_time);
        $birthday_year = date('Y', $birthday_time);
    }

    $values = [
        'full_name' => $receivedContact->full_name,
        'alias' => $receivedContact->alias,
        'address' => $receivedContact->address,
        'email' => $receivedContact->email,
        'phone1' => $receivedContact->phone1,
        'phone2' => $receivedContact->phone2,
        'birthday_day' => $birthday_day,
        'birthday_month' => $birthday_month,
        'birthday_year' => $birthday_year,
        'username' => $receivedContact->username,
        'timezone' => $receivedContact->timezone,
        'tags' => $receivedContact->tags,
        'favorite' => $receivedContact->favorite,
    ];

}

include_once 'fns/create_content.php';
$content = create_content($id, $values);

include_once '../../../fns/echo_page.php';
echo_page($user, "Edit Received Contact #$id", $content, '../../../');
