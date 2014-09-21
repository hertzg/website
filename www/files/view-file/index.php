<?php

include_once '../fns/ViewFilePage/create.php';
include_once '../../lib/mysqli.php';
$content = ViewFilePage\create($mysqli, $user, $file);
$id = $file->id_files;

$base = '../../';
$fnsDir = '../../fns';

include_once "$fnsDir/get_revision.php";
$confirmDialogJsRevision = get_revision('js/confirmDialog.js');

$content .=
    '<script type="text/javascript" defer="defer"'
    ." src=\"{$base}js/confirmDialog.js?$confirmDialogJsRevision\"></script>"
    .'<script type="text/javascript">'
        .'var deleteHref = '.json_encode("../delete-file/submit.php?id=$id")
    .'</script>'
    .'<script type="text/javascript" defer="defer" src="index.js"></script>';

unset(
    $_SESSION['files/errors'],
    $_SESSION['files/id_folders'],
    $_SESSION['files/messages'],
    $_SESSION['files/rename-file/errors'],
    $_SESSION['files/rename-file/values'],
    $_SESSION['files/send-file/errors'],
    $_SESSION['files/send-file/values']
);

include_once '../../fns/echo_page.php';
echo_page($user, "File #$id", $content, $base, [
    'head' => '<link rel="stylesheet" type="text/css"'
        ." href=\"{$base}css/confirmDialog/compressed.css\" />",
]);
