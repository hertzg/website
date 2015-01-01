<?php

include_once '../fns/require_received_folder.php';
include_once '../../../../lib/mysqli.php';
list($receivedFolder, $id, $user) = require_received_folder($mysqli, '../');

$key = 'files/received/folder/rename-and-import/values';
if (array_key_exists($key, $_SESSION)) $values = $_SESSION[$key];
else $values = (array)$receivedFolder;

unset($_SESSION['files/received/folder/messages']);

$fnsDir = '../../../../fns';

include_once "$fnsDir/Folders/maxLengths.php";
include_once "$fnsDir/Form/button.php";
include_once "$fnsDir/Form/hidden.php";
include_once "$fnsDir/Form/textfield.php";
include_once "$fnsDir/Page/sessionErrors.php";
include_once "$fnsDir/Page/tabs.php";
$content = Page\tabs(
    [
        [
            'title' => "Received Folder #$id",
            'href' => "../?id=$id#rename-and-import",
        ],
    ],
    'Rename and Import',
    Page\sessionErrors('files/received/folder/rename-and-import/errors')
    .'<form action="submit.php" method="post">'
        .Form\textfield('name', 'Folder name', [
            'value' => $values['name'],
            'maxlength' => Folders\maxLengths()['name'],
            'required' => true,
            'autofocus' => true,
        ])
        .'<div class="hr"></div>'
        .Form\button('Rename and Import')
        .Form\hidden('id', $id)
    .'</form>'
);

include_once "$fnsDir/echo_page.php";
$title = "Rename and Import Received Folder #$id";
echo_page($user, $title, $content, '../../../../');
