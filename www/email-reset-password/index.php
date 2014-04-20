<?php

$base = '../';

include_once '../fns/require_guest_user.php';
require_guest_user($base);

$key = 'email-reset-password/values';
if (array_key_exists($key, $_SESSION)) {
    $values = $_SESSION[$key];
} else {
    $values = ['email' => ''];
}

unset(
    $_SESSION['sign-in/errors'],
    $_SESSION['sign-in/values'],
    $_SESSION['sign-in/messages']
);

include_once '../fns/Page/tabs.php';
include_once '../fns/Form/button.php';
include_once '../fns/Form/captcha.php';
include_once '../fns/Form/textfield.php';
include_once '../fns/Page/sessionErrors.php';
$content = Page\tabs(
    [
        [
            'title' => 'Sign In',
            'href' => '../sign-in/',
        ],
    ],
    'Reset Password',
    Page\sessionErrors('email-reset-password/errors')
    .'<form action="submit.php" method="post">'
        .Form\textfield('email', 'Email', [
            'value' => $values['email'],
            'autofocus' => true,
            'required' => true,
        ])
        .'<div class="hr"></div>'
        .Form\captcha($base)
        .Form\button('Send Recovery Email')
    .'</form>'
);

include_once '../fns/echo_guest_page.php';
echo_guest_page('Reset Password', $content, $base);
