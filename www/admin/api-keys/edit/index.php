<?php

include_once '../../../../lib/defaults.php';

include_once '../fns/require_admin_api_key.php';
include_once '../../../lib/mysqli.php';
list($apiKey, $id, $admin_user) = require_admin_api_key($mysqli);

$fnsDir = '../../../fns';

$key = 'admin/api-keys/edit/values';
if (array_key_exists($key, $_SESSION)) $values = $_SESSION[$key];
else {

    include_once "$fnsDir/restore_expires.php";
    $values = [
        'name' => $apiKey->name,
        'expires' => restore_expires($apiKey->expire_time),
        'randomizeKey' => false,
    ];

    $permissions = ['invitation', 'user'];
    foreach ($permissions as $key) {
        $property = "can_read_{$key}s";
        if ($apiKey->$property) {
            $property = "can_write_{$key}s";
            if ($apiKey->$property) $access = 'readwrite';
            else $access = 'readonly';
        } else {
            $access = 'none';
        }
        $values["{$key}_access"] = $access;
    }

}

unset($_SESSION['admin/api-keys/view/messages']);

include_once '../fns/create_general_fields.php';
include_once '../fns/create_permission_fields.php';
include_once "$fnsDir/Form/button.php";
include_once "$fnsDir/Form/checkbox.php";
include_once "$fnsDir/ItemList/escapedItemQuery.php";
include_once "$fnsDir/ItemList/itemHiddenInputs.php";
include_once "$fnsDir/Page/create.php";
include_once "$fnsDir/Page/sessionErrors.php";
$content = Page\create(
    [
        'title' => "Admin API Key #$id",
        'href' => '../view/'.ItemList\escapedItemQuery($id).'#edit',
    ],
    'Edit',
    Page\sessionErrors('admin/api-keys/edit/errors')
    .'<form action="submit.php" method="post">'
        .create_general_fields($values)
        .'<div class="hr"></div>'
        .Form\checkbox('randomizeKey',
            'Randomize key', $values['randomizeKey'])
        .create_permission_fields($values)
        .'<div class="hr"></div>'
        .Form\button('Save Changes')
        .ItemList\itemHiddenInputs($id)
    .'</form>'
);

include_once '../../fns/echo_admin_page.php';
include_once "$fnsDir/compressed_js_script.php";
echo_admin_page($admin_user, "Edit Admin API Key #$id", $content, '../../', [
    'scripts' => compressed_js_script('formCheckbox', '../../../'),
]);
