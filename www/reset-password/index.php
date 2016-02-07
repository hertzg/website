<?php

include_once 'fns/require_valid_key.php';
include_once '../lib/mysqli.php';
list($user, $key, $id_users) = require_valid_key($mysqli);

$base = '../';

if (!$user) {
    include_once '../fns/echo_alert_page.php';
    echo_alert_page('Link Expired',
        'The link has expired. You should try again to reset your password.',
        '..', $base);
}

if (!$user->email_verified) {
    include_once '../fns/Users/Email/verify.php';
    Users\Email\verify($mysqli, $id_users);
}

include_once 'fns/get_values.php';
$values = get_values();

$focus = $values['focus'];
$return = $user->reset_password_return;

if ($return === '') $queryString = '';
else $queryString = '?return='.rawurlencode($return);

unset(
    $_SESSION['sign-in/errors'],
    $_SESSION['sign-in/messages'],
    $_SESSION['sign-in/values']
);

if ($user->num_password_protected_notes) {
    include_once '../fns/Page/warnings.php';
    $warnings = Page\warnings([
        'You have password-protected notes.',
        'If you reset your password you will'
        .' no longer be able to access them.',
    ]);
} else {
    $warnings = '';
}

include_once '../fns/example_password.php';
include_once '../fns/Form/button.php';
include_once '../fns/Form/label.php';
include_once '../fns/Form/notes.php';
include_once '../fns/Form/password.php';
include_once '../fns/Page/create.php';
include_once '../fns/Page/sessionErrors.php';
include_once '../fns/Password/minLength.php';
$content = Page\create(
    [
        'title' => 'Sign In',
        'href' => "../sign-in/$queryString#email-reset-password",
        'localNavigation' => true,
    ],
    'Reset Password',
    Page\sessionErrors('reset-password/errors')
    .$warnings
    .'<form action="submit.php" method="post">'
        .Form\label('Username', $user->username)
        .'<div class="hr"></div>'
        .Form\password('password', 'New password', [
            'value' => $values['password'],
            'autofocus' => $focus === 'password',
            'required' => true,
        ])
        .Form\notes([
            'Minimum '.Password\minLength().' characters.',
            'Example: '.example_password(9),
        ])
        .'<div class="hr"></div>'
        .Form\password('repeatPassword', 'Repeat new password', [
            'value' => $values['repeatPassword'],
            'autofocus' => $focus === 'repeatPassword',
            'required' => true,
        ])
        .'<div class="hr"></div>'
        .Form\button('Reset Password')
        ."<input type=\"hidden\" name=\"id_users\" value=\"$id_users\" />"
        .'<input type="hidden" name="key" value="'.bin2hex($key).'" />'
    .'</form>'
);

include_once '../fns/echo_page.php';
echo_page($user, 'Reset Password', $content, $base);
