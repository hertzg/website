<?php

include_once '../fns/require_received_file.php';
include_once '../../../../lib/mysqli.php';
list($receivedFile, $id, $user) = require_received_file($mysqli, '../');

unset($_SESSION['files/received/file/messages']);

$key = 'files/received/file/rename-and-import/values';
if (array_key_exists($key, $_SESSION)) $values = $_SESSION[$key];
else $values = ['name' => $receivedFile->name];

$fnsDir = '../../../../fns';

include_once '../../../fns/create_file_form_items.php';
include_once "$fnsDir/Form/button.php";
include_once "$fnsDir/ItemList/Received/itemHiddenInputs.php";
include_once "$fnsDir/ItemList/Received/itemQuery.php";
include_once "$fnsDir/Page/create.php";
include_once "$fnsDir/Page/sessionErrors.php";
$content = Page\create(
    [
        'title' => "Received File #$id",
        'href' => '../'.ItemList\Received\itemQuery($id).'#rename-and-import',
    ],
    'Rename and Import',
    Page\sessionErrors('files/received/file/rename-and-import/errors')
    .'<form action="submit.php" method="post">'
        .create_file_form_items($values)
        .'<div class="hr"></div>'
        .Form\button('Import File')
        .ItemList\Received\itemHiddenInputs($id)
    .'</form>'
);

include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, "Rename and Import Received File #$id",
    $content, '../../../../');
