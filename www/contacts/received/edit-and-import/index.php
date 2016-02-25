<?php

include_once '../../../../lib/defaults.php';

include_once '../fns/require_received_contact.php';
include_once '../../../lib/mysqli.php';
list($receivedContact, $id, $user) = require_received_contact($mysqli, '../');

unset($_SESSION['contacts/received/view/messages']);

$key = 'contacts/received/edit-and-import/values';
if (array_key_exists($key, $_SESSION)) $values = $_SESSION[$key];
else {

    $birthday_time = $receivedContact->birthday_time;
    if ($birthday_time === null) {
        $birthday_day = $birthday_month = $birthday_year = 0;
    } else {
        $birthday_day = date('j', $birthday_time);
        $birthday_month = date('n', $birthday_time);
        $birthday_year = date('Y', $birthday_time);
    }

    $values = [
        'focus' => 'full_name',
        'full_name' => $receivedContact->full_name,
        'alias' => $receivedContact->alias,
        'address' => $receivedContact->address,
        'email1' => $receivedContact->email1,
        'email1_label' => $receivedContact->email1_label,
        'email2' => $receivedContact->email2,
        'email2_label' => $receivedContact->email2_label,
        'phone1' => $receivedContact->phone1,
        'phone1_label' => $receivedContact->phone1_label,
        'phone2' => $receivedContact->phone2,
        'phone2_label' => $receivedContact->phone2_label,
        'birthday_day' => $birthday_day,
        'birthday_month' => $birthday_month,
        'birthday_year' => $birthday_year,
        'username' => $receivedContact->username,
        'timezone' => $receivedContact->timezone,
        'tags' => $receivedContact->tags,
        'notes' => $receivedContact->notes,
        'favorite' => $receivedContact->favorite,
    ];

}

include_once 'fns/create_content.php';
$content = create_content($id, $values, $scripts);

include_once '../../../fns/echo_user_page.php';
echo_user_page($user, "Edit and Import Received Contact #$id",
    $content, '../../../', ['scripts' => $scripts]);
