<?php

include_once '../fns/require_wallet.php';
include_once '../../lib/mysqli.php';
list($wallet, $id, $user) = require_wallet($mysqli);

unset($_SESSION['wallets/view/messages']);

$fnsDir = '../../fns';

include_once '../fns/create_view_page.php';
include_once "$fnsDir/Page/confirmDialog.php";
$content =
    create_view_page($wallet)
    .Page\confirmDialog('Are you sure you want to delete the wallet?',
        'Yes, delete wallet', "submit.php?id=$id", "../view/?id=$id");

include_once "$fnsDir/compressed_css_link.php";
include_once "$fnsDir/echo_page.php";
echo_page($user, "Delete Wallet #$id", $content, '../../', [
    'head' => compressed_css_link('confirmDialog'),
]);
