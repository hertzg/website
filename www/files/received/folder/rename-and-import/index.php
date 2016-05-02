<?php

include_once '../../../../../lib/defaults.php';

include_once '../fns/require_received_folder.php';
include_once '../../../../lib/mysqli.php';
list($receivedFolder, $id, $user) = require_received_folder($mysqli, '../');

unset($_SESSION['files/received/folder/messages']);

$key = 'files/received/folder/rename-and-import/values';
if (array_key_exists($key, $_SESSION)) $values = $_SESSION[$key];
else $values = ['name' => $receivedFolder->name];

$fnsDir = '../../../../fns';

include_once '../../../fns/create_folder_form_items.php';
include_once "$fnsDir/Form/button.php";
include_once "$fnsDir/ItemList/Received/itemHiddenInputs.php";
include_once "$fnsDir/ItemList/Received/itemQuery.php";
include_once "$fnsDir/Page/create.php";
include_once "$fnsDir/Page/sessionErrors.php";
$content = Page\create(
    [
        'title' => "Received Folder #$id",
        'href' => '../'.ItemList\Received\itemQuery($id).'#rename-and-import',
    ],
    'Rename and Import',
    Page\sessionErrors('files/received/folder/rename-and-import/errors')
    .'<form action="submit.php" method="post">'
        .create_folder_form_items($values)
        .Form\button('Rename and Import')
        .ItemList\Received\itemHiddenInputs($id)
    .'</form>'
);

include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, "Rename and Import Received Folder #$id",
    $content, '../../../../');
