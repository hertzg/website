<?php

$base = '../../';

include_once '../../fns/require_user.php';
$user = require_user($base);

$key = 'contacts/new/values';
if (array_key_exists($key, $_SESSION)) {
    $values = $_SESSION[$key];
} else {
    $values = [
        'full_name' => '',
        'alias' => '',
        'address' => '',
        'email' => '',
        'phone1' => '',
        'phone2' => '',
        'birthday_day' => 0,
        'birthday_month' => 0,
        'birthday_year' => 0,
        'username' => '',
        'tags' => '',
        'favorite' => false,
    ];
}

unset(
    $_SESSION['contacts/errors'],
    $_SESSION['contacts/messages']
);

include_once 'fns/create_content.php';
$content = create_content($base, $values);


include_once '../../fns/echo_page.php';
echo_page($user, 'New Contact', $content, $base);
