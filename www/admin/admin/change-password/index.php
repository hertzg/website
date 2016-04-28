<?php

include_once '../../../../lib/defaults.php';

include_once '../../fns/require_admin.php';
$admin_user = require_admin();

unset($_SESSION['admin/admin/messages']);

$fnsDir = '../../../fns';

$key = 'admin/admin/change-password/values';
if (array_key_exists($key, $_SESSION)) $values = $_SESSION[$key];
else {

    include_once "$fnsDir/Admin/get.php";
    Admin\get($username, $hash, $salt, $sha512_hash, $sha512_key);

    $values = [
        'focus' => 'password',
        'password' => '',
        'repeatPassword' => '',
    ];

}

$focus = $values['focus'];

include_once "$fnsDir/example_password.php";
include_once "$fnsDir/Form/button.php";
include_once "$fnsDir/Form/notes.php";
include_once "$fnsDir/Form/password.php";
include_once "$fnsDir/Form/textfield.php";
include_once "$fnsDir/Page/create.php";
include_once "$fnsDir/Page/sessionErrors.php";
include_once "$fnsDir/Password/minLength.php";
$content = Page\create(
    [
        'title' => 'Administrator',
        'href' => '../#change-password',
    ],
    'Change Password',
    Page\sessionErrors('admin/admin/change-password/errors')
    .'<form action="submit.php" method="post">'
        .Form\password('password', 'New password', [
            'value' => $values['password'],
            'required' => true,
            'autofocus' => $focus === 'password',
        ])
        .Form\notes([
            'Minimum '.Password\minLength().' characters.',
            'Example: '.htmlspecialchars(example_password(15)),
        ])
        .'<div class="hr"></div>'
        .Form\password('repeatPassword', 'Repeat new password', [
            'value' => $values['repeatPassword'],
            'required' => true,
            'autofocus' => $focus === 'repeatPassword',
        ])
        .'<div class="hr"></div>'
        .Form\button('Change Password', null, $focus === 'button')
    .'</form>'
);

include_once '../../fns/echo_admin_page.php';
echo_admin_page($admin_user, 'Change Password', $content, '../../');
