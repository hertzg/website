<?php

$base = '../../';
$fnsDir = '../../fns';

include_once "$fnsDir/require_user.php";
$user = require_user($base);

unset(
    $_SESSION['wallets/errors'],
    $_SESSION['wallets/messages']
);

include_once "$fnsDir/Wallets/indexOnUser.php";
include_once '../../lib/mysqli.php';
$wallets = Wallets\indexOnUser($mysqli, $user->id_users);

$walletOptions = [];
foreach ($wallets as $wallet) {
    $walletOptions[$wallet->id] = htmlspecialchars($wallet->name);
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
include_once "$fnsDir/Page/sessionErrors.php";
include_once "$fnsDir/Page/tabs.php";
$content = Page\tabs(
    [
        [
            'title' => 'Wallets',
            'href' => '../#new-transaction',
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
    .'</form>'
);

include_once "$fnsDir/echo_page.php";
echo_page($user, 'New Transaction', $content, $base);