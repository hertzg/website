<?php

include_once '../fns/require_api_key.php';
include_once '../../../lib/mysqli.php';
list($apiKey, $id, $user) = require_api_key($mysqli);

$base = '../../../';
$fnsDir = '../../../fns';

unset(
    $_SESSION['account/api-keys/edit/errors'],
    $_SESSION['account/api-keys/edit/values'],
    $_SESSION['account/api-keys/errors'],
    $_SESSION['account/api-keys/messages']
);

include_once '../fns/ViewPage/create.php';
include_once "$fnsDir/compressed_js_script.php";
$content =
    ViewPage\create($user, $apiKey)
    .compressed_js_script('confirmDialog', $base)
    .'<script type="text/javascript">'
        .'var deleteHref = '.json_encode("../delete/submit.php?id=$id")
    .'</script>'
    .'<script type="text/javascript" defer="defer" src="index.js?1"></script>';

include_once "$fnsDir/compressed_css_link.php";
include_once "$fnsDir/echo_page.php";
echo_page($user, "API Key #$id", $content, $base, [
    'head' => compressed_css_link('confirmDialog', $base),
]);
