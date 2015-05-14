<?php

include_once '../fns/require_transactions.php';
include_once '../../../lib/mysqli.php';
list($wallet, $id, $user) = require_transactions($mysqli, '../');

$base = '../../../';
$fnsDir = '../../../fns';

include_once '../fns/SearchPage/create.php';
include_once "$fnsDir/compressed_js_script.php";
$content =
    SearchPage\create($mysqli, $user, $wallet, $scripts)
    .compressed_js_script('confirmDialog', $base)
    .'<script type="text/javascript">'
        ."var deleteAllHref = 'delete-all/submit.php?id=$id'"
    .'</script>'
    .'<script type="text/javascript" defer="defer" src="index.js?1"></script>';

include_once "$fnsDir/echo_page.php";
echo_page($user, "All Transactions in Wallet #$id", $content, $base, [
    'scripts' => $scripts,
]);