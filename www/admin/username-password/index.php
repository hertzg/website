<?php

include_once '../fns/require_admin.php';
require_admin();

unset($_SESSION['admin/messages']);

$key = 'admin/username-password/values';
if (array_key_exists($key, $_SESSION)) $values = $_SESSION[$key];
else {

    include_once '../../fns/Admin/get.php';
    Admin\get($username, $hash, $salt, $sha512_hash, $sha512_key);

    $values = [
        'focus' => 'username',
        'username' => $username,
        'password' => '',
        'repeatPassword' => '',
    ];

}

$focus = $values['focus'];

include_once '../../fns/Form/button.php';
include_once '../../fns/Form/password.php';
include_once '../../fns/Form/textfield.php';
include_once '../../fns/Page/sessionErrors.php';
include_once '../../fns/Page/tabs.php';
include_once '../../fns/Username/maxLength.php';
$content = Page\tabs(
    [
        [
            'title' => 'Administration',
            'href' => '../#username-password',
        ],
    ],
    'Set New Username/Password',
    Page\sessionErrors('admin/username-password/errors')
    .'<form action="submit.php" method="post">'
        .Form\textfield('username', 'New username', [
            'value' => $values['username'],
            'maxlength' => Username\maxLength(),
            'required' => true,
            'autofocus' => $focus === 'username',
        ])
        .'<div class="hr"></div>'
        .Form\password('password', 'New password', [
            'value' => $values['password'],
            'required' => true,
            'autofocus' => $focus === 'password',
        ])
        .'<div class="hr"></div>'
        .Form\password('repeatPassword', 'Repeat new password', [
            'value' => $values['repeatPassword'],
            'required' => true,
            'autofocus' => $focus === 'repeatPassword',
        ])
        .'<div class="hr"></div>'
        .Form\button('Set Username/Password', null, $focus === 'button')
    .'</form>'
);

include_once '../fns/echo_admin_page.php';
echo_admin_page('Set New Username/Password', $content, '../');
