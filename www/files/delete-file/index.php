<?php

include_once '../../../lib/defaults.php';

include_once '../fns/require_file.php';
include_once '../../lib/mysqli.php';
list($file, $id, $user) = require_file($mysqli);

$base = '../../';
$fnsDir = '../../fns';

unset(
    $_SESSION['files/view-file/errors'],
    $_SESSION['files/view-file/messages']
);

include_once '../fns/ViewFilePage/create.php';
include_once "$fnsDir/Page/confirmDialog.php";
$content =
    ViewFilePage\create($mysqli, $file, $scripts)
    .Page\confirmDialog('Are you sure you want to delete the file?'
    .' It will be moved to Trash.', 'Yes, delete file', "submit.php?id=$id",
    "../view-file/?id=$id");

include_once "$fnsDir/compressed_css_link.php";
include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, "Delete File #$id?", $content, $base, [
    'head' => compressed_css_link('confirmDialog', $base),
    'scripts' => $scripts,
]);
