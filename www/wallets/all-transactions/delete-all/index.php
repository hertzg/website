<?php

include_once '../fns/require_transactions.php';
include_once '../../../lib/mysqli.php';
list($wallet, $id, $user) = require_transactions($mysqli, '../');

$base = '../../../';
$fnsDir = '../../../fns';

include_once '../fns/create_all_transactions_page.php';
include_once "$fnsDir/Page/confirmDialog.php";
$content =
    create_all_transactions_page($mysqli, $user, $wallet, '../')
    .Page\confirmDialog(
        'Are you sure you want to delete all the transactions?',
        'Yes, delete all transactions', "submit.php?id=$id", "../?id=$id");

include_once "$fnsDir/compressed_css_link.php";
include_once "$fnsDir/echo_page.php";
echo_page($user, 'All Transactions', $content, $base, [
    'head' => compressed_css_link('confirmDialog', $base),
]);
