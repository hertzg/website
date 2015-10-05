<?php

include_once '../fns/require_user.php';
include_once '../../../lib/mysqli.php';
list($user, $id) = require_user($mysqli);

unset($_SESSION['admin/users/view/messages']);

$key = 'admin/users/edit-profile/values';
if (array_key_exists($key, $_SESSION)) $values = $_SESSION[$key];
else {
    $values = [
        'username' => $user->username,
        'disabled' => $user->disabled,
    ];
}

$fnsDir = '../../../fns';

include_once "$fnsDir/ItemList/escapedItemQuery.php";
$escapedItemQuery = ItemList\escapedItemQuery($id);

include_once "$fnsDir/Form/button.php";
include_once "$fnsDir/Form/checkbox.php";
include_once "$fnsDir/Form/notes.php";
include_once "$fnsDir/Form/textfield.php";
include_once "$fnsDir/Page/sessionErrors.php";
include_once "$fnsDir/Page/tabs.php";
include_once "$fnsDir/Username/maxLength.php";
include_once "$fnsDir/Username/minLength.php";
$content = Page\tabs(
    [
        [
            'title' => "User #$id",
            'href' => "../view/$escapedItemQuery#edit-profile",
        ],
    ],
    'Edit Profile',
    Page\sessionErrors('admin/users/edit-profile/errors')
    .'<form action="submit.php" method="post">'
        .Form\textfield('username', 'Username', [
            'value' => $values['username'],
            'maxlength' => Username\maxLength(),
            'required' => true,
            'autofocus' => true,
        ])
        .Form\notes([
            'Characters a-z, A-Z, 0-9, dash, dot and underscore only.',
            'Minimum '.Username\minLength().' characters.',
        ])
        .'<div class="hr"></div>'
        .Form\checkbox('disabled', 'Disable', $values['disabled'])
        .'<div class="hr"></div>'
        .Form\button('Save Changes')
        ."<input type=\"hidden\" name=\"id\" value=\"$id\" />"
    .'</form>'
);

include_once '../../fns/echo_admin_page.php';
include_once "$fnsDir/compressed_js_script.php";
echo_admin_page("Edit User #$id Profile", $content, '../../', [
    'scripts' => compressed_js_script('formCheckbox', '../../../'),
]);
