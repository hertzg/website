<?php

include_once '../fns/require_api_key.php';
include_once '../../../lib/mysqli.php';
list($apiKey, $id, $user) = require_api_key($mysqli);

unset($_SESSION['account/api-keys/view/messages']);

$base = '../../../';
$fnsDir = '../../../fns';

$key = 'account/api-keys/edit/values';
if (array_key_exists($key, $_SESSION)) {
    $values = $_SESSION[$key];
} else {

    include_once "$fnsDir/restore_expires.php";
    $values = [
        'name' => $apiKey->name,
        'expires' => restore_expires($apiKey->expire_time),
        'randomizeKey' => false,
    ];

    $permissions = ['bar_chart', 'bookmark', 'calculation',
        'channel', 'contact', 'event', 'file', 'note',
        'notification', 'place', 'schedule', 'task', 'wallet'];
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
        'title' => "API Key #$id",
        'href' => '../view/'.ItemList\escapedItemQuery($id).'#edit',
    ],
    'Edit',
    Page\sessionErrors('account/api-keys/edit/errors')
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

include_once "$fnsDir/compressed_js_script.php";
include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, "Edit API Key #$id", $content, $base, [
    'scripts' => compressed_js_script('formCheckbox', $base),
]);
