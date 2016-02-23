<?php

include_once '../fns/require_connection.php';
include_once '../../../lib/mysqli.php';
list($connection, $id, $admin_user) = require_connection($mysqli, '../');

$fnsDir = '../../../fns';

$key = 'admin/connections/edit/values';
if (array_key_exists($key, $_SESSION)) $values = $_SESSION[$key];
else {
    include_once "$fnsDir/restore_expires.php";
    $values = [
        'focus' => 'address',
        'address' => $connection->address,
        'their_exchange_api_key' => $connection->their_exchange_api_key,
        'expires' => restore_expires($connection->expire_time),
        'randomizeKey' => false,
    ];
}

unset(
    $_SESSION['admin/connections/view/errors'],
    $_SESSION['admin/connections/view/messages']
);

include_once '../fns/create_form_items.php';
include_once "$fnsDir/Form/button.php";
include_once "$fnsDir/Form/checkbox.php";
include_once "$fnsDir/ItemList/escapedItemQuery.php";
include_once "$fnsDir/ItemList/itemHiddenInputs.php";
include_once "$fnsDir/Page/create.php";
include_once "$fnsDir/Page/sessionErrors.php";
$content = Page\create(
    [
        'title' => "Connection #$id",
        'href' => '../view/'.ItemList\escapedItemQuery($id).'#edit',
    ],
    'Edit',
    Page\sessionErrors('admin/connections/edit/errors')
    .'<form action="submit.php" method="post">'
        .create_form_items($values)
        .'<div class="hr"></div>'
        .Form\checkbox('randomizeKey',
            'Randomize our key', $values['randomizeKey'])
        .'<div class="hr"></div>'
        .Form\button('Save Changes')
        .ItemList\itemHiddenInputs($id)
    .'</form>'
);

include_once '../../fns/echo_admin_page.php';
include_once "$fnsDir/compressed_js_script.php";
echo_admin_page($admin_user, "Edit Connection #$id", $content, '../../', [
    'scripts' => compressed_js_script('formCheckbox', '../../../'),
]);
