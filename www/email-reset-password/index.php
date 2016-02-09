<?php

$base = '../';

include_once '../fns/require_guest_user.php';
require_guest_user($base);

include_once 'fns/get_values.php';
$values = get_values();

$focus = $values['focus'];
$return = $values['return'];

if ($return === '') $queryString = '';
else $queryString = '?return='.rawurlencode($return);

include_once 'fns/unset_session_vars.php';
unset_session_vars();

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
