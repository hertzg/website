<?php

include_once 'fns/require_multiple_wallets.php';
$user = require_multiple_wallets();

$base = '../../';
$fnsDir = '../../fns';

include_once 'fns/unset_session_vars.php';
unset_session_vars();

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
$values = get_values($wallets);

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
        'href' => ItemList\listHref().'#transfer-amount',
    ],
    'Transfer Amount',
    Page\sessionErrors('wallets/quick-transfer-amount/errors')
    .'<form action="submit.php" method="post">'
        .Form\select('from_id_wallets', 'From', $walletOptions,
            $values['from_id_wallets'], $focus === 'from_id_wallets')
        .'<div class="hr"></div>'
        .Form\select('to_id_wallets', 'To', $walletOptions,
            $values['to_id_wallets'], $focus === 'to_id_wallets')
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
echo_user_page($user, 'Transfer Amount', $content, $base);
