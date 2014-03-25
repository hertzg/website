<?php

$base = '../';

include_once '../fns/require_guest_user.php';
require_guest_user($base);

if (array_key_exists('email-reset-password/index_values', $_SESSION)) {
    $values = $_SESSION['email-reset-password/index_values'];
} else {
    $values = array('email' => '');
}

unset(
    $_SESSION['sign-in/index_errors'],
    $_SESSION['sign-in/index_values'],
    $_SESSION['sign-in/index_messages']
);

include_once '../fns/create_tabs.php';
include_once '../fns/Form/button.php';
include_once '../fns/Form/captcha.php';
include_once '../fns/Form/textfield.php';
include_once '../fns/Page/sessionErrors.php';
$content =
    create_tabs(
        array(
            array(
                'title' => 'Sign In',
                'href' => '../sign-in/',
            ),
        ),
        'Reset Password',
        Page\sessionErrors('email-reset-password/index_errors')
        .'<form action="submit.php" method="post">'
            .Form\textfield('email', 'Email', array(
                'value' => $values['email'],
                'autofocus' => true,
                'required' => true,
            ))
            .'<div class="hr"></div>'
            .Form\captcha($base)
            .Form\button('Send Recovery Email')
        .'</form>'
    );

include_once '../fns/echo_guest_page.php';
echo_guest_page('Reset Password', $content, $base);
