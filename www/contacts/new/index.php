<?php

include_once '../../../lib/defaults.php';

$base = '../../';
$fnsDir = '../../fns';

include_once "$fnsDir/require_user.php";
$user = require_user($base);

$key = 'contacts/new/values';
if (array_key_exists($key, $_SESSION)) $values = $_SESSION[$key];
else {

    include_once "$fnsDir/Contacts/request.php";
    list($full_name, $alias, $address, $email1,
        $email1_label, $email2, $email2_label, $phone1,
        $phone1_label, $phone2, $phone2_label, $birthday_time,
        $username, $timezone, $tags, $notes, $favorite) = Contacts\request();

    if ($birthday_time === null) {
        $birthday_day = $birthday_month = $birthday_year = 0;
    } else {
        $birthday_day = date('j', $birthday_time);
        $birthday_month = date('n', $birthday_time);
        $birthday_year = date('Y', $birthday_time);
    }

    $values = [
        'focus' => 'full_name',
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
        'username' => $username,
        'timezone' => $timezone,
        'tags' => $tags,
        'notes' => $notes,
        'favorite' => $favorite,
    ];

}

unset(
    $_SESSION['contacts/errors'],
    $_SESSION['contacts/messages'],
    $_SESSION['contacts/view/messages'],
    $_SESSION['home/messages']
);

include_once 'fns/create_content.php';
$content = create_content($values, $scripts);

include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, 'New Contact', $content, $base, ['scripts' => $scripts]);
