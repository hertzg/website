<?php

$base = '../';

include_once '../fns/require_guest_user.php';
require_guest_user($base);

$key = 'email-reset-password/values';
if (array_key_exists($key, $_SESSION)) $values = $_SESSION[$key];
else {

    include_once '../fns/request_strings.php';
    list($return) = request_strings('return');

    $values = [
        'focus' => 'email',
        'email' => '',
        'return' => $return,
    ];

}

$focus = $values['focus'];
$return = $values['return'];

if ($return === '') $queryString = '';
else $queryString = '?return='.rawurlencode($return);

unset(
    $_SESSION['sign-in/errors'],
    $_SESSION['sign-in/messages'],
    $_SESSION['sign-in/values']
);

include_once '../fns/Email/maxLength.php';
include_once '../fns/Form/button.php';
include_once '../fns/Form/captcha.php';
include_once '../fns/Form/hidden.php';
include_once '../fns/Form/textfield.php';
include_once '../fns/Page/create.php';
include_once '../fns/Page/sessionErrors.php';
$content = Page\create(
    [
        'title' => 'Sign In',
        'href' => "../sign-in/$queryString#email-reset-password",
        'localNavigation' => true,
    ],
    'Reset Password',
    Page\sessionErrors('email-reset-password/errors')
    .'<form action="submit.php" method="post">'
        .Form\textfield('email', 'Email', [
            'value' => $values['email'],
            'maxlength' => Email\maxLength(),
            'autofocus' => $focus === 'email',
            'required' => true,
        ])
        .'<div class="hr"></div>'
        .Form\captcha($base, $focus === 'captcha')
        .Form\button('Send Recovery Email')
        .Form\hidden('return', $return)
    .'</form>'
);

include_once '../fns/echo_guest_page.php';
echo_guest_page('Reset Password', $content, $base);
