<?php

include_once '../fns/require_received_folder.php';
include_once '../../../../lib/mysqli.php';
list($receivedFolder, $id, $user) = require_received_folder($mysqli, '../');

$key = 'files/received/folder/rename-and-import/values';
if (array_key_exists($key, $_SESSION)) $values = $_SESSION[$key];
else $values = (array)$receivedFolder;

unset($_SESSION['files/received/folder/messages']);

$fnsDir = '../../../../fns';

include_once "$fnsDir/Form/button.php";
include_once "$fnsDir/Form/hidden.php";
include_once "$fnsDir/Form/textfield.php";
include_once "$fnsDir/Page/sessionErrors.php";
include_once "$fnsDir/Page/tabs.php";
$content = Page\tabs(
    [
        [
            'title' => '&middot;&middot;&middot;',
            'href' => '../..',
        ],
        [
            'title' => "Received Folder #$id",
            'href' => "../?id=$id",
        ],
    ],
    'Rename and Import',
    Page\sessionErrors('files/received/folder/rename-and-import/errors')
    .'<form action="submit.php" method="post">'
        .Form\textfield('name', 'Folder name', [
            'value' => $values['name'],
            'required' => true,
            'autofocus' => true,
        ])
        .'<div class="hr"></div>'
        .Form\button('Rename and Import')
        .Form\hidden('id', $id)
    .'</form>'
);

include_once "$fnsDir/echo_page.php";
echo_page($user, "Delete Received Folder #$id", $content, '../../../../');
