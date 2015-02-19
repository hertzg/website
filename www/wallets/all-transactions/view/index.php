<?php

include_once '../fns/require_transaction.php';
include_once '../../../lib/mysqli.php';
list($transaction, $id, $user) = require_transaction($mysqli);

$base = '../../../';
$fnsDir = '../../../fns';

include_once '../fns/create_view_page.php';
include_once "$fnsDir/compressed_js_script.php";
$content =
    create_view_page($transaction)
    .compressed_js_script('confirmDialog', $base)
    .'<script type="text/javascript">'
        ."var deleteHref = '../delete/submit.php?id=$id'"
    .'</script>'
    .'<script type="text/javascript"'
    .' defer="defer" src="../../view-transaction.js">'
    .'</script>';

include_once "$fnsDir/compressed_css_link.php";
include_once "$fnsDir/echo_page.php";
echo_page($user, "Transaction #$id", $content, $base, [
    'head' => compressed_css_link('confirmDialog', $base),
]);
