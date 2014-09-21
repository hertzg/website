<?php

include_once 'fns/require_optional_folder.php';
include_once '../lib/mysqli.php';
list($user, $folder, $id_folders) = require_optional_folder($mysqli, './');

$base = '../';
$fnsDir = '../fns';

include_once 'fns/create_page.php';
$content = create_page($mysqli, $user, $folder);

if ($id_folders) {

    include_once "$fnsDir/get_revision.php";
    $confirmDialogJsRevision = get_revision('js/confirmDialog.js');

    $content .=
        '<script type="text/javascript" defer="defer"'
        ." src=\"{$base}js/confirmDialog.js?$confirmDialogJsRevision\"></script>"
        .'<script type="text/javascript">'
            .'var deleteHref = '.json_encode("delete-folder/submit.php?id_folders=$id_folders")
        .'</script>'
        .'<script type="text/javascript" defer="defer" src="index.js"></script>';

}

include_once 'fns/unset_session_vars.php';
unset_session_vars();

include_once "$fnsDir/echo_page.php";
echo_page($user, 'Files', $content, $base, [
    'head' => '<link rel="stylesheet" type="text/css"'
        ." href=\"{$base}css/confirmDialog/compressed.css\" />",
]);
