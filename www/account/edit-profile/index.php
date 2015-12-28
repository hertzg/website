<?php

$base = '../../';
$fnsDir = '../../fns';

include_once "$fnsDir/require_user.php";
$user = require_user($base);

$key = 'account/edit-profile/values';
if (array_key_exists($key, $_SESSION)) $values = $_SESSION[$key];
else {
    $values = [
        'focus' => 'username',
        'username' => $user->username,
        'email' => $user->email,
        'full_name' => $user->full_name,
        'timezone' => $user->timezone,
    ];
}

$focus = $values['focus'];

unset($_SESSION['account/messages']);

include_once "$fnsDir/Email/maxLength.php";
include_once "$fnsDir/Form/button.php";
include_once "$fnsDir/Form/notes.php";
include_once "$fnsDir/Form/textfield.php";
include_once "$fnsDir/Form/timezoneSelect.php";
include_once "$fnsDir/FullName/maxLength.php";
include_once "$fnsDir/Page/create.php";
include_once "$fnsDir/Page/sessionErrors.php";
include_once "$fnsDir/Username/maxLength.php";
include_once "$fnsDir/Username/minLength.php";
$content = Page\create(
    [
        'title' => 'Account',
        'href' => '../#edit-profile',
    ],
    'Edit Profile',
    Page\sessionErrors('account/edit-profile/errors')
    .'<form action="submit.php" method="post">'
        .Form\textfield('username', 'Username', [
            'value' => $values['username'],
            'maxlength' => Username\maxLength(),
            'autofocus' => $focus === 'username',
            'required' => true,
        ])
        .Form\notes([
            'Case-sensitive.',
            'Characters a-z, A-Z, 0-9, dash, dot and underscore only.',
            'Minimum '.Username\minLength().' characters.',
        ])
        .'<div class="hr"></div>'
        .Form\textfield('email', 'Email', [
            'value' => $values['email'],
            'maxlength' => Email\maxLength(),
            'autofocus' => $focus === 'email',
        ])
        .Form\notes(['Optional. Used for password recovery.'])
        .'<div class="hr"></div>'
        .Form\textfield('full_name', 'Full name', [
            'value' => $values['full_name'],
            'maxlength' => FullName\maxLength(),
        ])
        .'<div class="hr"></div>'
        .Form\timezoneSelect('timezone', 'Timezone', $values['timezone'])
        .'<div class="hr"></div>'
        .Form\button('Save Changes')
    .'</form>'
);

include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, 'Edit Profile', $content, $base);
