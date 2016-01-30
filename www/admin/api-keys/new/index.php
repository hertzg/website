<?php

include_once '../../fns/require_admin.php';
$admin_user = require_admin();

$key = 'admin/api-keys/new/values';
if (array_key_exists($key, $_SESSION)) $values = $_SESSION[$key];
else {
    $values = [
        'name' => '',
        'expires' => 'never',
        'invitation_access' => 'none',
        'user_access' => 'none',
    ];
}

unset(
    $_SESSION['admin/api-keys/errors'],
    $_SESSION['admin/api-keys/messages'],
    $_SESSION['admin/api-keys/view/messages']
);

$fnsDir = '../../../fns';

include_once '../fns/create_general_fields.php';
include_once '../fns/create_permission_fields.php';
include_once "$fnsDir/Form/button.php";
include_once "$fnsDir/ItemList/listHref.php";
include_once "$fnsDir/ItemList/pageHiddenInputs.php";
include_once "$fnsDir/Page/create.php";
include_once "$fnsDir/Page/sessionErrors.php";
$content = Page\create(
    [
        'title' => 'Admin API Keys',
        'href' => ItemList\listHref(),
    ],
    'New Admin API Key',
    Page\sessionErrors('admin/api-keys/new/errors')
    .'<form action="submit.php" method="post">'
        .create_general_fields($values)
        .create_permission_fields($values)
        .'<div class="hr"></div>'
        .Form\button('Generate Admin API Key')
        .ItemList\pageHiddenInputs()
    .'</form>'
);

include_once '../../fns/echo_admin_page.php';
echo_admin_page($admin_user, 'New Admin API Key', $content, '../../');
