<?php

$base = '../../';

include_once '../../fns/require_user.php';
$user = require_user($base);

$key = 'account/change-password/values';
if (array_key_exists($key, $_SESSION)) {
    $values = $_SESSION[$key];
} else {
    $values = [
        'currentPassword' => '',
        'password1' => '',
        'password2' => '',
    ];
}

unset($_SESSION['account/messages']);

include_once '../../fns/Page/tabs.php';
include_once '../../fns/Form/button.php';
include_once '../../fns/Form/notes.php';
include_once '../../fns/Form/password.php';
include_once '../../fns/Page/sessionErrors.php';
$content = Page\tabs(
    [
        [
            'title' => '&middot;&middot;&middot;',
            'href' => '../../home/',
        ],
        [
            'title' => 'Account',
            'href' => '..',
        ],
    ],
    'Change Password',
    Page\sessionErrors('account/change-password/errors')
    .'<form action="submit.php" method="post">'
        .Form\password('currentPassword', 'Current password', [
            'value' => $values['currentPassword'],
            'autofocus' => true,
            'required' => true,
        ])
        .'<div class="hr"></div>'
        .Form\password('password1', 'New password', [
            'value' => $values['password1'],
            'required' => true,
        ])
        .Form\notes(['Minimum 6 characters.'])
        .'<div class="hr"></div>'
        .Form\password('password2', 'Repeat new password', [
            'value' => $values['password2'],
            'required' => true,
        ])
        .'<div class="hr"></div>'
        .Form\button('Change')
    .'</form>'
);

include_once '../../fns/echo_page.php';
echo_page($user, 'Change Password', $content, $base);
