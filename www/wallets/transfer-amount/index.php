<?php

include_once 'fns/require_wallet_and_multiple_wallets.php';
include_once '../../lib/mysqli.php';
list($wallet, $id, $user) = require_wallet_and_multiple_wallets($mysqli);

$key = 'wallets/transfer-amount/values';
if (array_key_exists($key, $_SESSION)) $values = $_SESSION[$key];
else {
    $values = [
        'focus' => 'to_id',
        'to_id' => '',
        'amount' => '',
        'description' => '',
    ];
}

$base = '../../';
$fnsDir = '../../fns';

include_once "$fnsDir/Users/Wallets/index.php";
$wallets = Users\Wallets\index($mysqli, $user);

$options = [];
foreach ($wallets as $wallet) {
    $to_id = $wallet->id;
    if ($to_id == $id) continue;
    $options[$to_id] = htmlspecialchars($wallet->name);
}

unset(
    $_SESSION['wallets/view/errors'],
    $_SESSION['wallets/view/messages']
);

include_once '../fns/create_transfer_form_items.php';
include_once "$fnsDir/ItemList/escapedItemQuery.php";
include_once "$fnsDir/ItemList/itemHiddenInputs.php";
include_once "$fnsDir/Page/create.php";
include_once "$fnsDir/Page/sessionErrors.php";
$content = Page\create(
    [
        'title' => "Wallet #$id",
        'href' => '../view/'.ItemList\escapedItemQuery($id),
    ],
    'Transfer Amount',
    Page\sessionErrors('wallets/transfer-amount/errors')
    .'<form action="submit.php" method="post">'
        .create_transfer_form_items($values, $options)
        .ItemList\itemHiddenInputs($id)
    .'</form>'
);

if ($user->num_wallets > 1) {

    include_once "$fnsDir/Page/imageLinkWithDescription.php";
    $link = Page\imageLinkWithDescription('Transfer Amount',
        'From another wallet', '../quick-transfer-amount/',
        'transfer-amount', ['localNavigation' => true]);

    include_once "$fnsDir/create_panel.php";
    $content .= create_panel('Options', $link);

}

include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, 'Transfer Amount', $content, '../../');
