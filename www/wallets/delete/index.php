<?php

include_once '../../../lib/defaults.php';

include_once '../fns/require_wallet.php';
include_once '../../lib/mysqli.php';
list($wallet, $id, $user) = require_wallet($mysqli);

unset(
    $_SESSION['wallets/view/errors'],
    $_SESSION['wallets/view/messages']
);

$base = '../../';
$fnsDir = '../../fns';

include_once "$fnsDir/ItemList/escapedItemQuery.php";
$escapedItemQuery = ItemList\escapedItemQuery($id);

include_once '../fns/ViewPage/create.php';
include_once "$fnsDir/Page/confirmDialog.php";
$content =
    ViewPage\create($mysqli, $user, $wallet, $scripts, $head)
    .Page\confirmDialog('Are you sure you want to delete the wallet?'
        .' It will be moved to Trash.', 'Yes, delete wallet',
        "submit.php$escapedItemQuery", "../view/$escapedItemQuery");

include_once "$fnsDir/compressed_css_link.php";
include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, "Delete Wallet #$id?", $content, $base, [
    'head' => $head.compressed_css_link('confirmDialog', $base),
    'scripts' => $scripts,
]);
