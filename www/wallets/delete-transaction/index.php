<?php

include_once '../fns/require_transaction.php';
include_once '../../lib/mysqli.php';
list($transaction, $id, $user) = require_transaction($mysqli);

$base = '../../';
$fnsDir = '../../fns';

unset($_SESSION['wallets/view-transaction/messages']);

include_once '../fns/create_view_transaction_page.php';
include_once "$fnsDir/compressed_js_script.php";
include_once "$fnsDir/Page/confirmDialog.php";
$content =
    create_view_page($transaction)
    .Page\confirmDialog('Are you sure you want to delete the transaction?',
        'Yes, delete transaction', "submit.php?id=$id",
        "../view-transaction/?id=$id");

include_once "$fnsDir/compressed_css_link.php";
include_once "$fnsDir/echo_page.php";
echo_page($user, "Delete Transaction #$id?", $content, $base, [
    'head' => compressed_css_link('confirmDialog', $base),
]);
