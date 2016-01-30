<?php

include_once '../fns/require_user.php';
include_once '../../../lib/mysqli.php';
list($user, $id, $admin_user) = require_user($mysqli);

unset($_SESSION['admin/users/view/messages']);

$key = 'admin/users/reset-password/values';
if (array_key_exists($key, $_SESSION)) $values = $_SESSION[$key];
else {
    $values = [
        'focus' => 'password',
        'password' => '',
        'repeatPassword' => '',
    ];
}

$focus = $values['focus'];
$fnsDir = '../../../fns';

include_once "$fnsDir/ItemList/escapedItemQuery.php";
$escapedItemQuery = ItemList\escapedItemQuery($id);

if ($user->num_password_protected_notes) {
    include_once "$fnsDir/Page/warnings.php";
    $warnings = Page\warnings([
        'The user has password-protected notes.',
        'If you reset the user\'s password the user will'
        .' no longer be able to access them.',
    ]);
} else {
    $warnings = '';
}

include_once "$fnsDir/example_password.php";
include_once "$fnsDir/Form/button.php";
include_once "$fnsDir/Form/notes.php";
include_once "$fnsDir/Form/password.php";
include_once "$fnsDir/Page/create.php";
include_once "$fnsDir/Page/sessionErrors.php";
include_once "$fnsDir/Password/minLength.php";
$content = Page\create(
    [
        'title' => "User #$id",
        'href' => "../view/$escapedItemQuery#reset-password",
    ],
    'Reset Password',
    Page\sessionErrors('admin/users/reset-password/errors')
    .$warnings
    .'<form action="submit.php" method="post">'
        .Form\password('password', 'New password', [
            'value' => $values['password'],
            'required' => true,
            'autofocus' => $focus === 'password',
        ])
        .Form\notes([
            'Minimum '.Password\minLength().' characters.',
            'Example: '.htmlspecialchars(example_password(9)),
        ])
        .'<div class="hr"></div>'
        .Form\password('repeatPassword', 'Repeat new password', [
            'value' => $values['repeatPassword'],
            'required' => true,
            'autofocus' => $focus === 'repeatPassword',
        ])
        .'<div class="hr"></div>'
        .Form\button('Reset Password')
        ."<input type=\"hidden\" name=\"id\" value=\"$id\" />"
    .'</form>'
);

include_once '../../fns/echo_admin_page.php';
echo_admin_page($admin_user, "Reset User #$id Password", $content, '../../');
