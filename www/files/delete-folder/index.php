<?php

include_once '../../../lib/defaults.php';

include_once '../fns/require_folder.php';
include_once '../../lib/mysqli.php';
list($folder, $id_folders, $user) = require_folder($mysqli);

$base = '../../';
$fnsDir = '../../fns';

unset(
    $_SESSION['files/errors'],
    $_SESSION['files/id_folders'],
    $_SESSION['files/messages']
);

include_once '../fns/create_page.php';
include_once "$fnsDir/Page/confirmDialog.php";
$content =
    create_page($mysqli, $user, $folder, $scripts, $title, '../')
    .Page\confirmDialog('Are you sure you want to delete the folder?'
        .' It will be moved to Trash.', 'Yes, delete folder',
        "submit.php?id_folders=$id_folders", "../?id_folders=$id_folders");

include_once "$fnsDir/compressed_css_link.php";
include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, "Delete Folder #$id_folders?", $content, $base, [
    'head' => compressed_css_link('confirmDialog', $base),
    'scripts' => $scripts,
]);
