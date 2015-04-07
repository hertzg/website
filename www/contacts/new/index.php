<?php

$base = '../../';
$fnsDir = '../../fns';

include_once "$fnsDir/require_user.php";
$user = require_user($base);

$key = 'contacts/new/values';
if (array_key_exists($key, $_SESSION)) {
    $values = $_SESSION[$key];
} else {

    include_once "$fnsDir/Contacts/request.php";
    list($full_name, $alias, $address, $email,
        $phone1, $phone2, $birthday_time, $username,
        $timezone, $tags, $notes, $favorite) = Contacts\request();

    if ($birthday_time === null) {
        $birthday_day = $birthday_month = $birthday_year = 0;
    } else {
        $birthday_day = date('j', $birthday_time);
        $birthday_month = date('n', $birthday_time);
        $birthday_year = date('Y', $birthday_time);
    }

    $values = [
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
        'timezone' => $timezone,
        'tags' => $tags,
        'notes' => $notes,
        'favorite' => $favorite,
    ];
}

unset(
    $_SESSION['contacts/errors'],
    $_SESSION['contacts/messages'],
    $_SESSION['home/messages']
);

include_once 'fns/create_content.php';
$content = create_content($values);

include_once "$fnsDir/echo_page.php";
echo_page($user, 'New Contact', $content, $base);
