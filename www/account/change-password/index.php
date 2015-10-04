<?php

$base = '../../';
$fnsDir = '../../fns';

include_once "$fnsDir/require_user.php";
$user = require_user($base);

$key = 'account/change-password/values';
if (array_key_exists($key, $_SESSION)) $values = $_SESSION[$key];
else {
    $values = [
        'currentPassword' => '',
        'password1' => '',
        'password2' => '',
    ];
}

unset($_SESSION['account/messages']);

include_once "$fnsDir/example_password.php";
include_once "$fnsDir/phishing_warning.php";
include_once "$fnsDir/Form/button.php";
include_once "$fnsDir/Form/notes.php";
include_once "$fnsDir/Form/password.php";
include_once "$fnsDir/Page/sessionErrors.php";
include_once "$fnsDir/Page/tabs.php";
include_once "$fnsDir/Password/minLength.php";
$content = Page\tabs(
    [
        [
            'title' => 'Account',
            'href' => '../#change-password',
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
        .Form\notes([
            'Minimum '.Password\minLength().' characters.',
            'Exaple: '.example_password(9),
        ])
        .'<div class="hr"></div>'
        .Form\password('password2', 'Repeat new password', [
            'value' => $values['password2'],
            'required' => true,
        ])
        .'<div class="hr"></div>'
        .Form\button('Set Password')
        .phishing_warning()
    .'</form>'
);

include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, 'Change Password', $content, $base);
