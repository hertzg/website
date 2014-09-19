<?php

include_once '../fns/require_api_key.php';
include_once '../../../lib/mysqli.php';
list($apiKey, $id, $user) = require_api_key($mysqli);

include_once '../../../fns/get_revision.php';
$confirmDialogJsRevision = get_revision('js/confirmDialog.js');

include_once '../fns/ViewPage/create.php';
$content =
    ViewPage\create($apiKey)
    .'<script type="text/javascript" defer="defer"'
    ." src=\"../../../js/confirmDialog.js?$confirmDialogJsRevision\"></script>"
    .'<script type="text/javascript">'
        .'var deleteHref = '.json_encode("../delete/submit.php?id=$id")
    .'</script>'
    .'<script type="text/javascript" defer="defer" src="index.js?1"></script>';

include_once '../../../fns/echo_page.php';
echo_page($user, "API Key #$id", $content, '../../../', [
    'head' => '<link rel="stylesheet" type="text/css"'
        .' href="../../../confirmDialog.compressed.css" />',
]);
