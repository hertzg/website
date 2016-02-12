<?php

include_once 'fns/require_one_wallet.php';
$user = require_one_wallet();

include_once 'fns/unset_session_vars.php';
unset_session_vars();

$base = '../../';
$fnsDir = '../../fns';

include_once "$fnsDir/Wallets/indexOnUser.php";
include_once '../../lib/mysqli.php';
$wallets = Wallets\indexOnUser($mysqli, $user->id_users);

include_once "$fnsDir/amount_text.php";
$walletOptions = [];
foreach ($wallets as $wallet) {
    $walletOptions[$wallet->id] = htmlspecialchars($wallet->name)
        .' &middot; '.amount_text($wallet->balance);
}

include_once 'fns/get_values.php';
$values = get_values();

$focus = $values['focus'];

include_once "$fnsDir/WalletTransactions/maxLengths.php";
$maxLengths = WalletTransactions\maxLengths();

include_once '../fns/create_transaction_form_items.php';
include_once "$fnsDir/Form/button.php";
include_once "$fnsDir/Form/select.php";
include_once "$fnsDir/Form/textfield.php";
include_once "$fnsDir/ItemList/listHref.php";
include_once "$fnsDir/ItemList/pageHiddenInputs.php";
include_once "$fnsDir/Page/create.php";
include_once "$fnsDir/Page/sessionErrors.php";
$content = Page\create(
    [
        'title' => 'Wallets',
        'href' => ItemList\listHref().'#new-transaction',
    ],
    'New Transaction',
    Page\sessionErrors('wallets/quick-new-transaction/errors')
    .'<form action="submit.php" method="post">'
        .Form\select('id_wallets', 'Wallet', $walletOptions,
            $values['id_wallets'], $focus === 'id_wallets')
        .'<div class="hr"></div>'
        .Form\textfield('amount', 'Amount', [
            'value' => $values['amount'],
            'required' => true,
            'autofocus' => $focus === 'amount',
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

include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, 'New Transaction', $content, $base);
