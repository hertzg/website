<?php

include_once '../../../../lib/defaults.php';

include_once '../../fns/require_admin.php';
$admin_user = require_admin();

unset($_SESSION['admin/admin/messages']);

$fnsDir = '../../../fns';

$key = 'admin/admin/edit-profile/values';
if (array_key_exists($key, $_SESSION)) $values = $_SESSION[$key];
else {

    include_once "$fnsDir/Admin/get.php";
    Admin\get($username, $hash, $salt, $sha512_hash, $sha512_key);

    $values = [
        'focus' => 'username',
        'username' => $username,
    ];

}

$focus = $values['focus'];

include_once "$fnsDir/Form/button.php";
include_once "$fnsDir/Form/notes.php";
include_once "$fnsDir/Form/textfield.php";
include_once "$fnsDir/Page/create.php";
include_once "$fnsDir/Page/sessionErrors.php";
include_once "$fnsDir/Username/maxLength.php";
include_once "$fnsDir/Username/minLength.php";
$content = Page\create(
    [
        'title' => 'Administrator',
        'href' => '../#edit-profile',
    ],
    'Edit Profile',
    Page\sessionErrors('admin/admin/edit-profile/errors')
    .'<form action="submit.php" method="post">'
        .Form\textfield('username', 'Username', [
            'value' => $values['username'],
            'maxlength' => Username\maxLength(),
            'required' => true,
            'autofocus' => $focus === 'username',
        ])
        .Form\notes([
            'Case-sensitive.',
            'Characters a-z, A-Z, 0-9, dash, dot and underscore only.',
            'Minimum '.Username\minLength().' characters.',
        ])
        .'<div class="hr"></div>'
        .Form\button('Save Changes', null, $focus === 'button')
    .'</form>'
);

include_once '../../fns/echo_admin_page.php';
echo_admin_page($admin_user, 'Edit Profile', $content, '../../');
