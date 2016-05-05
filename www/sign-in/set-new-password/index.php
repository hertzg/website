<?php

include_once '../../../lib/defaults.php';

include_once 'fns/require_user_with_reset_password.php';
$user = require_user_with_reset_password();

$key = 'sign-in/set-new-password/values';
if (array_key_exists($key, $_SESSION)) $values = $_SESSION[$key];
else {

    include_once '../../fns/request_strings.php';
    list($return) = request_strings('return');

    $values = [
        'focus' => 'password',
        'password' => '',
        'repeatPassword' => '',
        'return' => $return,
    ];

}

$focus = $values['focus'];

include_once '../../fns/example_password.php';
include_once '../../fns/Form/button.php';
include_once '../../fns/Form/hidden.php';
include_once '../../fns/Form/notes.php';
include_once '../../fns/Form/password.php';
include_once '../../fns/Page/create.php';
include_once '../../fns/Page/sessionErrors.php';
include_once '../../fns/Page/warnings.php';
include_once '../../fns/Password/minLength.php';
$content = Page\create(
    [
        'title' => 'Sign Out',
        'href' => '../../sign-out/submit.php',
    ],
    'Set New Password',
    Page\warnings([
        'This password has been set by an administrator.',
        'You should set your own password to ensure your account security.',
    ])
    .Page\sessionErrors('sign-in/set-new-password/errors')
    .'<form action="submit.php" method="post">'
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
        .Form\button('Save Password')
        .Form\hidden('return', $values['return'])
    .'</form>'
);

include_once '../../fns/echo_page.php';
echo_page(null, 'Set New Password', $content, '../../');
