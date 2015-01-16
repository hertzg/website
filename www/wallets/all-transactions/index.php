<?php

include_once 'fns/require_transactions.php';
include_once '../../lib/mysqli.php';
list($wallet, $id, $user) = require_transactions($mysqli);

$base = '../../';
$fnsDir = '../../fns';

include_once 'fns/create_all_transactions_page.php';
include_once "$fnsDir/compressed_js_script.php";
$content =
    create_all_transactions_page($mysqli, $user, $wallet)
    .compressed_js_script('confirmDialog', $base)
    .'<script type="text/javascript">'
        ."var deleteAllHref = 'delete-all/submit.php?id=$id'"
    .'</script>'
    .'<script type="text/javascript" defer="defer" src="index.js"></script>';

include_once "$fnsDir/echo_page.php";
echo_page($user, 'All Transactions', $content, $base);
