<?php

include_once 'fns/require_transactions.php';
include_once '../../lib/mysqli.php';
list($wallet, $id, $user) = require_transactions($mysqli);

$base = '../../';
$fnsDir = '../../fns';

include_once 'fns/create_page.php';
$content = create_page($mysqli, $user, $wallet, $scripts);

include_once "$fnsDir/compressed_js_script.php";
include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, "All Transactions in Wallet #$id", $content, $base, [
    'scripts' => $scripts.compressed_js_script('confirmDialog', $base)
        .'<script type="text/javascript">'
            ."var deleteAllHref = 'delete-all/submit.php?id=$id'"
        .'</script>'
        .'<script type="text/javascript" src="index.js?2"></script>',
]);
