<?php

include_once '../../fns/require_admin.php';
require_admin();

$key = 'admin/api-keys/new/values';
if (array_key_exists($key, $_SESSION)) $values = $_SESSION[$key];
else $values = ['name' => ''];

unset($_SESSION['admin/api-keys/messages']);

$fnsDir = '../../../fns';

include_once "$fnsDir/ApiKeyName/maxLength.php";
include_once "$fnsDir/Form/button.php";
include_once "$fnsDir/Form/textfield.php";
include_once "$fnsDir/Page/sessionErrors.php";
include_once "$fnsDir/Page/tabs.php";
$content = Page\tabs(
    [
        [
            'title' => 'Admin API Keys',
            'href' => '..',
        ],
    ],
    'New Admin API Key',
    Page\sessionErrors('admin/api-keys/new/errors')
    .'<form action="submit.php" method="post">'
        .Form\textfield('name', 'Name', [
            'value' => $values['name'],
            'maxlength' => ApiKeyName\maxLength(),
            'required' => true,
            'autofocus' => true,
        ])
        .'<div class="hr"></div>'
        .Form\button('Generate Admin API Key')
    .'</form>'
);

include_once '../../fns/echo_admin_page.php';
echo_admin_page('New Admin API Key', $content, '../../');
