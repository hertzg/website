<?php

include_once '../fns/require_admin_api_key.php';
include_once '../../../lib/mysqli.php';
list($apiKey, $id) = require_admin_api_key($mysqli);

$key = 'admin/api-keys/edit/values';
if (array_key_exists($key, $_SESSION)) $values = $_SESSION[$key];
else {

    $values = [
        'name' => $apiKey->name,
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

$fnsDir = '../../../fns';

include_once '../fns/create_general_fields.php';
include_once '../fns/create_permission_fields.php';
include_once "$fnsDir/Form/button.php";
include_once "$fnsDir/Form/checkbox.php";
include_once "$fnsDir/Page/sessionErrors.php";
include_once "$fnsDir/Page/tabs.php";
$content = Page\tabs(
    [
        [
            'title' => "Admin API Key #$id",
            'href' => "../view/?id=$id#edit",
        ],
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
        ."<input type=\"hidden\" name=\"id\" value=\"$id\" />"
    .'</form>'
);

include_once '../../fns/echo_admin_page.php';
include_once "$fnsDir/compressed_js_script.php";
echo_admin_page("Edit Admin API Key #$id", $content, '../../', [
    'scripts' => compressed_js_script('formCheckbox', '../../../'),
]);