<?php

include_once '../fns/require_token.php';
include_once '../../../lib/mysqli.php';
list($token, $id, $user) = require_token($mysqli);

unset(
    $_SESSION['account/tokens/errors'],
    $_SESSION['account/tokens/messages']
);

include_once '../../../fns/get_revision.php';
$confirmDialogJsRevision = get_revision('js/confirmDialog.js');

include_once '../fns/create_view_page.php';
$content =
    create_view_page($token)
    .'<script type="text/javascript" defer="defer"'
    ." src=\"../../../js/confirmDialog.js?$confirmDialogJsRevision\"></script>"
    .'<script type="text/javascript">'
        .'var deleteHref = '.json_encode("../delete/submit.php?id=$id")
    .'</script>'
    .'<script type="text/javascript" defer="defer" src="index.js?1"></script>';

include_once '../../../fns/echo_page.php';
echo_page($user, "Session #$id", $content, '../../../', [
    'head' => '<link rel="stylesheet" type="text/css"'
        .' href="../../../confirmDialog.compressed.css" />',
]);
