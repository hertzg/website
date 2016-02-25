<?php

include_once '../../../lib/defaults.php';

include_once '../fns/require_transaction.php';
include_once '../../lib/mysqli.php';
list($transaction, $id, $user) = require_transaction($mysqli);

unset($_SESSION['wallets/view-transaction/messages']);

$base = '../../';
$fnsDir = '../../fns';

include_once "$fnsDir/ItemList/escapedItemQuery.php";
$escapedItemQuery = ItemList\escapedItemQuery($id);

include_once '../fns/ViewTransactionPage/create.php';
include_once "$fnsDir/Page/confirmDialog.php";
$content =
    ViewTransactionPage\create($transaction, $scripts)
    .Page\confirmDialog('Are you sure you want to delete the transaction?',
        'Yes, delete transaction', "submit.php$escapedItemQuery",
        "../view-transaction/$escapedItemQuery");

include_once "$fnsDir/compressed_css_link.php";
include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, "Delete Transaction #$id?", $content, $base, [
    'head' => compressed_css_link('confirmDialog', $base),
    'scripts' => $scripts,
]);
