<?php

include_once '../fns/require_received_file.php';
include_once '../../../../lib/mysqli.php';
list($receivedFile, $id, $user) = require_received_file($mysqli, '../');

unset($_SESSION['files/received/file/messages']);

$key = 'files/received/file/rename-and-import/values';
if (array_key_exists($key, $_SESSION)) $values = $_SESSION[$key];
else $values = (array)$receivedFile;

$fnsDir = '../../../../fns';

include_once "$fnsDir/Page/tabs.php";
include_once "$fnsDir/Form/button.php";
include_once "$fnsDir/Form/hidden.php";
include_once "$fnsDir/Form/textfield.php";
include_once "$fnsDir/Page/sessionErrors.php";
$content = Page\tabs(
    [
        [
            'title' => '&middot;&middot;&middot;',
            'href' => '../..',
        ],
        [
            'title' => "Received File #$id",
            'href' => "../?id=$id",
        ],
    ],
    'Rename and Import',
    Page\sessionErrors('files/received/file/rename-and-import/errors')
    .'<form action="submit.php" method="post">'
        .Form\textfield('name', 'File name', [
            'value' => $values['name'],
            'required' => true,
            'autofocus' => true,
        ])
        .'<div class="hr"></div>'
        .Form\button('Import File')
        .Form\hidden('id', $id)
    .'</form>'
);

include_once "$fnsDir/echo_page.php";
echo_page($user, "Rename and Import Received File #$id", $content, '../../../../');
