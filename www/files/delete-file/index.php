<?php

include_once '../fns/ViewFilePage/create.php';
include_once '../../lib/mysqli.php';
$content = ViewFilePage\create($mysqli, $user, $file);
$id = $file->id_files;

$base = '../../';
$fnsDir = '../../fns';

include_once "$fnsDir/Page/confirmDialog.php";
$content .= Page\confirmDialog('Are you sure you want to delete the file?'
    .' It will be moved to Trash.', 'Yes, delete file', "submit.php?id=$id",
    "../view-file/?id=$id");

unset($_SESSION['files/view-file/messages']);

include_once "$fnsDir/echo_page.php";
echo_page($user, "Delete File #$id?", $content, $base, [
    'head' => '<link rel="stylesheet" type="text/css"'
        ." href=\"{$base}css/confirmDialog/compressed.css\" />",
]);
