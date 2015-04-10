<?php

include_once '../fns/require_connection.php';
include_once '../../../lib/mysqli.php';
list($connection, $id, $user) = require_connection($mysqli);

$base = '../../../';
$fnsDir = '../../../fns';

unset(
    $_SESSION['account/connections/edit/errors'],
    $_SESSION['account/connections/edit/values'],
    $_SESSION['account/connections/errors'],
    $_SESSION['account/connections/messages']
);

include_once '../fns/create_view_page.php';
include_once "$fnsDir/compressed_js_script.php";
$content =
    create_view_page($connection, $scripts)
    .compressed_js_script('confirmDialog', $base)
    .'<script type="text/javascript">'
        .'var deleteHref = '.json_encode("../delete/submit.php?id=$id")
    .'</script>'
    .'<script type="text/javascript" defer="defer" src="index.js?1"></script>';

include_once "$fnsDir/compressed_css_link.php";
include_once "$fnsDir/echo_page.php";
echo_page($user, "Connection #$id", $content, $base, [
    'head' =>
        '<link rel="stylesheet" type="text/css" href="../view.css" />'
        .compressed_css_link('confirmDialog', $base),
    'scripts' => $scripts,
]);
