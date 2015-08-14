<?php

include_once '../../fns/require_admin.php';
require_admin();

$key = 'admin/users/new/values';
if (array_key_exists($key, $_SESSION)) $values = $_SESSION[$key];
else {
    $values = [
        'username' => '',
        'password' => '',
        'repeatPassword' => '',
    ];
}

$fnsDir = '../../../fns';

unset(
    $_SESSION['admin/users/errors'],
    $_SESSION['admin/users/messages']
);

include_once "$fnsDir/Form/button.php";
include_once "$fnsDir/Form/password.php";
include_once "$fnsDir/Form/textfield.php";
include_once "$fnsDir/Page/sessionErrors.php";
include_once "$fnsDir/Page/tabs.php";
include_once "$fnsDir/Username/maxLength.php";
$content = Page\tabs(
    [
        [
            'title' => 'Users',
            'href' => '..',
        ],
    ],
    'New User',
    Page\sessionErrors('admin/users/new/errors')
    .'<form action="submit.php" method="post">'
        .Form\textfield('username', 'Username', [
            'value' => $values['username'],
            'maxlength' => Username\maxLength(),
            'required' => true,
            'autofocus' => true,
        ])
        .'<div class="hr"></div>'
        .Form\password('password', 'Password', [
            'value' => $values['password'],
            'required' => true,
        ])
        .'<div class="hr"></div>'
        .Form\password('repeatPassword', 'Repeat password', [
            'value' => $values['repeatPassword'],
            'required' => true,
        ])
        .'<div class="hr"></div>'
        .Form\button('Save User')
    .'</form>'
);

include_once "$fnsDir/echo_guest_page.php";
echo_guest_page('New User', $content, '../../../');
