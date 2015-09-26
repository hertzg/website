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
}

unset($_SESSION['admin/api-keys/view/messages']);

$fnsDir = '../../../fns';

include_once "$fnsDir/ApiKeyName/maxLength.php";
include_once "$fnsDir/Form/button.php";
include_once "$fnsDir/Form/checkbox.php";
include_once "$fnsDir/Form/textfield.php";
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
        .Form\textfield('name', 'Name', [
            'value' => $values['name'],
            'maxlength' => ApiKeyName\maxLength(),
            'required' => true,
            'autofocus' => true,
        ])
        .'<div class="hr"></div>'
        .Form\checkbox('randomizeKey',
            'Randomize key', $values['randomizeKey'])
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
