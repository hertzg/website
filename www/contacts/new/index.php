<?php

$base = '../../';
$fnsDir = '../../fns';

include_once "$fnsDir/require_user.php";
$user = require_user($base);

$key = 'contacts/new/values';
if (array_key_exists($key, $_SESSION)) {
    $values = $_SESSION[$key];
} else {

    include_once "$fnsDir/request_strings.php";
    list($email, $phone1) = request_strings('email', 'phone1');

    $values = [
        'full_name' => '',
        'alias' => '',
        'address' => '',
        'email' => $email,
        'phone1' => $phone1,
        'phone2' => '',
        'birthday_day' => 0,
        'birthday_month' => 0,
        'birthday_year' => 0,
        'username' => '',
        'timezone' => null,
        'tags' => '',
        'notes' => '',
        'favorite' => false,
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
