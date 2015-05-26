<?php

include_once 'fns/require_wallet_and_multiple_wallets.php';
include_once '../../lib/mysqli.php';
list($wallet, $id, $user) = require_wallet_and_multiple_wallets($mysqli);

$key = 'wallets/transfer-amount/values';
if (array_key_exists($key, $_SESSION)) $values = $_SESSION[$key];
else {
    $values = [
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

include_once "$fnsDir/WalletTransactions/maxLengths.php";
$maxLengths = WalletTransactions\maxLengths();

unset(
    $_SESSION['wallets/view/errors'],
    $_SESSION['wallets/view/messages']
);

include_once "$fnsDir/Form/button.php";
include_once "$fnsDir/Form/select.php";
include_once "$fnsDir/Form/textfield.php";
include_once "$fnsDir/ItemList/escapedItemQuery.php";
include_once "$fnsDir/ItemList/itemHiddenInputs.php";
include_once "$fnsDir/Page/sessionErrors.php";
include_once "$fnsDir/Page/tabs.php";
$content = Page\tabs(
    [
        [
            'title' => "Wallet #$id",
            'href' => '../view/'.ItemList\escapedItemQuery($id),
        ],
    ],
    'Transfer Amount',
    Page\sessionErrors('wallets/transfer-amount/errors')
    .'<form action="submit.php" method="post">'
        .Form\select('to_id', 'To', $options, $values['to_id'])
        .'<div class="hr"></div>'
        .Form\textfield('amount', 'Amount', [
            'value' => $values['amount'],
            'autofocus' => true,
            'required' => true,
        ])
        .'<div class="hr"></div>'
        .Form\textfield('description', 'Description', [
            'value' => $values['description'],
            'maxlength' => $maxLengths['description'],
        ])
        .'<div class="hr"></div>'
        .Form\button('Save Transaction')
        .ItemList\itemHiddenInputs($id)
    .'</form>'
);

include_once "$fnsDir/echo_page.php";
echo_page($user, 'Transfer Amount', $content, '../../');
