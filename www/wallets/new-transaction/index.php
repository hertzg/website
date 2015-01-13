<?php

include_once '../fns/require_wallet.php';
include_once '../../lib/mysqli.php';
list($wallet, $id, $user) = require_wallet($mysqli);

$key = 'wallets/new-transaction/values';
if (array_key_exists($key, $_SESSION)) $values = $_SESSION[$key];
else {
    $values = [
        'amount' => '',
        'description' => '',
    ];
}

$base = '../../';
$fnsDir = '../../fns';

include_once "$fnsDir/WalletTransactions/maxLengths.php";
$maxLengths = WalletTransactions\maxLengths();

include_once "$fnsDir/Form/button.php";
include_once "$fnsDir/Form/hidden.php";
include_once "$fnsDir/Form/textfield.php";
include_once "$fnsDir/Page/sessionErrors.php";
include_once "$fnsDir/Page/tabs.php";
$content = Page\tabs(
    [
        [
            'title' => "Wallet #$id",
            'href' => "../view/?id=$id#new-transaction",
        ]
    ],
    'New Transaction',
    Page\sessionErrors('wallets/new-transaction/errors')
    .'<form action="submit.php" method="post">'
        .Form\textfield('amount', 'Amount', [
            'value' => $values['amount'],
            'autofocus' => true,
            'required' => true,
        ])
        .'<div class="hr"></div>'
        .Form\textfield('description', 'Description', [
            'maxlength' => $maxLengths['description'],
        ])
        .'<div class="hr"></div>'
        .\Form\button('Save Transaction')
        .\Form\hidden('id', $id)
    .'</form>'
);

include_once "$fnsDir/echo_page.php";
echo_page($user, '', $content, $base);
