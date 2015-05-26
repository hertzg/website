<?php

include_once '../fns/require_wallets.php';
$user = require_wallets();

$base = '../../';
$fnsDir = '../../fns';

unset(
    $_SESSION['home/messages'],
    $_SESSION['wallets/errors'],
    $_SESSION['wallets/messages']
);

include_once "$fnsDir/Wallets/indexOnUser.php";
include_once '../../lib/mysqli.php';
$wallets = Wallets\indexOnUser($mysqli, $user->id_users);

include_once "$fnsDir/amount_text.php";
$walletOptions = [];
foreach ($wallets as $wallet) {
    $walletOptions[$wallet->id] = htmlspecialchars($wallet->name)
        .' &middot; '.amount_text($wallet->balance);
}

$key = 'wallets/quick-new-transaction/values';
if (array_key_exists($key, $_SESSION)) $values = $_SESSION[$key];
else {
    $values = [
        'id_wallets' => '',
        'amount' => '',
        'description' => '',
    ];
}

include_once "$fnsDir/WalletTransactions/maxLengths.php";
$maxLengths = WalletTransactions\maxLengths();

include_once '../fns/create_transaction_form_items.php';
include_once "$fnsDir/Form/button.php";
include_once "$fnsDir/Form/select.php";
include_once "$fnsDir/Form/textfield.php";
include_once "$fnsDir/ItemList/listHref.php";
include_once "$fnsDir/ItemList/pageHiddenInputs.php";
include_once "$fnsDir/Page/sessionErrors.php";
include_once "$fnsDir/Page/tabs.php";
$content = Page\tabs(
    [
        [
            'title' => 'Wallets',
            'href' => ItemList\listHref().'#new-transaction',
        ],
    ],
    'New Transaction',
    Page\sessionErrors('wallets/quick-new-transaction/errors')
    .'<form action="submit.php" method="post">'
        .Form\select('id_wallets', 'Wallet', $walletOptions,
            $values['id_wallets'], ['autofocus' => true])
        .'<div class="hr"></div>'
        .Form\textfield('amount', 'Amount', [
            'value' => $values['amount'],
            'required' => true,
        ])
        .'<div class="hr"></div>'
        .Form\textfield('description', 'Description', [
            'value' => $values['description'],
            'maxlength' => $maxLengths['description'],
        ])
        .'<div class="hr"></div>'
        .Form\button('Save Transaction')
        .ItemList\pageHiddenInputs()
    .'</form>'
);

include_once "$fnsDir/echo_page.php";
echo_page($user, 'New Transaction', $content, $base);
