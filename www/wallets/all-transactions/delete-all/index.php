<?php

include_once '../../../../lib/defaults.php';

include_once '../fns/require_transactions.php';
include_once '../../../lib/mysqli.php';
list($wallet, $id, $user) = require_transactions($mysqli, '../');

$base = '../../../';
$fnsDir = '../../../fns';

unset($_SESSION['wallets/all-transactions/messages']);

include_once "$fnsDir/ItemList/pageParams.php";
$pageParams = ItemList\pageParams();

if (array_key_exists('keyword', $pageParams)) {
    include_once '../fns/SearchPage/create.php';
    $content = SearchPage\create($mysqli, $user, $wallet, $scripts, '../');
} else {
    include_once '../fns/create_page.php';
    $content = create_page($mysqli, $user, $wallet, $scripts, '../');
}

include_once '../fns/create_page.php';
include_once "$fnsDir/ItemList/listHref.php";
include_once "$fnsDir/Page/confirmDialog.php";
$content .= Page\confirmDialog(
    'Are you sure you want to delete all the transactions?',
    'Yes, delete all transactions', "submit.php?id=$id",
    '../'.ItemList\listHref('', ['id' => $id]));

include_once "$fnsDir/compressed_css_link.php";
include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, "Delete All Transactions in Wallet #$id?",
    $content, $base, [
    'head' => compressed_css_link('confirmDialog', $base),
    'scripts' => $scripts,
]);
