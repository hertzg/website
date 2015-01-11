<?php

$base = '../../';
$fnsDir = '../../fns';

include_once '../fns/require_wallet.php';
include_once '../../lib/mysqli.php';
list($wallet, $id, $user) = require_wallet($mysqli);

include_once '../fns/create_view_page.php';
include_once "$fnsDir/compressed_js_script.php";
$content =
    create_view_page($wallet)
    .compressed_js_script('confirmDialog', $base)
    .'<script type="text/javascript">'
        .'var deleteHref = '.json_encode("../delete/submit.php?id=$id")
    .'</script>'
    .'<script type="text/javascript" defer="defer" src="index.js"></script>';

include_once "$fnsDir/compressed_css_link.php";
include_once "$fnsDir/echo_page.php";
echo_page($user, "Wallet #$id", $content, $base, [
    'head' => compressed_css_link('confirmDialog', $base),
]);
