<?php

include_once '../fns/require_admin.php';
require_admin();

unset($_SESSION['admin/messages']);

$key = 'admin/username-password/values';
if (array_key_exists($key, $_SESSION)) $values = $_SESSION[$key];
else {

    include_once '../../fns/Admin/get.php';
    Admin\get($username, $hash, $salt);

    $values = [
        'username' => $username,
        'password1' => '',
        'password2' => '',
    ];

}

include_once '../../fns/Form/button.php';
include_once '../../fns/Form/password.php';
include_once '../../fns/Form/textfield.php';
include_once '../../fns/Page/sessionErrors.php';
include_once '../../fns/Page/tabs.php';
$content = Page\tabs(
    [
        [
            'title' => 'Administration',
            'href' => '..',
        ],
    ],
    'Set New Username/Password',
    Page\sessionErrors('admin/username-password/errors')
    .'<form action="submit.php" method="post">'
        .Form\textfield('username', 'New username', [
            'value' => $values['username'],
            'required' => true,
            'autofocus' => true,
        ])
        .'<div class="hr"></div>'
        .Form\password('password1', 'New password', [
            'value' => $values['password1'],
            'required' => true,
        ])
        .'<div class="hr"></div>'
        .Form\password('password2', 'Repeat new password', [
            'value' => $values['password2'],
            'required' => true,
        ])
        .'<div class="hr"></div>'
        .Form\button('Set Username/Password')
    .'</form>'
);

include_once '../../fns/echo_guest_page.php';
echo_guest_page('Set New Username/Password', $content, '../../');
