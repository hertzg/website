<?php

include_once '../../../../lib/defaults.php';

include_once '../fns/require_user.php';
include_once '../../../lib/mysqli.php';
list($user, $id, $admin_user) = require_user($mysqli);

unset($_SESSION['admin/users/view/messages']);

$key = 'admin/users/edit-profile/values';
if (array_key_exists($key, $_SESSION)) $values = $_SESSION[$key];
else {
    $values = [
        'focus' => 'username',
        'username' => $user->username,
        'email' => $user->email,
        'full_name' => $user->full_name,
        'timezone' => $user->timezone,
        'admin' => $user->admin,
        'disabled' => $user->disabled,
        'expires' => $user->expires,
    ];
}

$focus = $values['focus'];

$fnsDir = '../../../fns';

include_once "$fnsDir/ItemList/escapedItemQuery.php";
$escapedItemQuery = ItemList\escapedItemQuery($id);

include_once '../fns/create_profile_form_items.php';
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
        'title' => "User #$id",
        'href' => "../view/$escapedItemQuery#edit-profile",
    ],
    'Edit Profile',
    Page\sessionErrors('admin/users/edit-profile/errors')
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
        .create_profile_form_items($values, $scripts)
        .'<div class="hr"></div>'
        .Form\button('Save Changes')
        ."<input type=\"hidden\" name=\"id\" value=\"$id\" />"
    .'</form>'
);

include_once '../../fns/echo_admin_page.php';
echo_admin_page($admin_user, "Edit User #$id Profile",
    $content, '../../', ['scripts' => $scripts]);
