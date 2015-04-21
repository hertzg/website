<?php

include_once '../fns/require_received_file.php';
include_once '../../../../lib/mysqli.php';
list($receivedFile, $id, $user) = require_received_file($mysqli, '../');

unset($_SESSION['files/received/file/messages']);

$key = 'files/received/file/rename-and-import/values';
if (array_key_exists($key, $_SESSION)) $values = $_SESSION[$key];
else $values = (array)$receivedFile;

$fnsDir = '../../../../fns';

include_once "$fnsDir/FileName/maxLength.php";
include_once "$fnsDir/Form/button.php";
include_once "$fnsDir/Form/hidden.php";
include_once "$fnsDir/Form/textfield.php";
include_once "$fnsDir/Page/sessionErrors.php";
include_once "$fnsDir/Page/tabs.php";
$content = Page\tabs(
    [
        [
            'title' => "Received File #$id",
            'href' => "../?id=$id#rename-and-import",
        ],
    ],
    'Rename and Import',
    Page\sessionErrors('files/received/file/rename-and-import/errors')
    .'<form action="submit.php" method="post">'
        .Form\textfield('name', 'File name', [
            'value' => $values['name'],
            'maxlength' => FileName\maxLength(),
            'required' => true,
            'autofocus' => true,
        ])
        .'<div class="hr"></div>'
        .Form\button('Import File')
        .Form\hidden('id', $id)
    .'</form>'
);

$title = "Rename and Import Received File #$id";
include_once "$fnsDir/echo_page.php";
echo_page($user, $title, $content, '../../../../');
