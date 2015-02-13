<?php

include_once '../../fns/require_wallet.php';
include_once '../../../lib/mysqli.php';
list($wallet, $id, $user) = require_wallet($mysqli, '../');

unset($_SESSION['wallets/view/messages']);

$key = 'wallets/all-transaction/new/values';
if (array_key_exists($key, $_SESSION)) $values = $_SESSION[$key];
else {
    $values = [
        'amount' => '',
        'description' => '',
    ];
}

$base = '../../../';
$fnsDir = '../../../fns';

include_once '../../fns/create_transaction_form_items.php';
include_once "$fnsDir/Form/button.php";
include_once "$fnsDir/Form/hidden.php";
include_once "$fnsDir/Page/sessionErrors.php";
include_once "$fnsDir/Page/tabs.php";
$content = Page\tabs(
    [
        [
            'title' => 'All Transactions',
            'href' => "../?id=$id",
        ]
    ],
    'New Transaction',
    Page\sessionErrors('wallets/all-transaction/new/errors')
    .'<form action="submit.php" method="post">'
        .create_transaction_form_items($values)
        .'<div class="hr"></div>'
        .\Form\button('Save Transaction')
        .\Form\hidden('id', $id)
    .'</form>'
);

include_once "$fnsDir/echo_page.php";
echo_page($user, 'New Transaction', $content, $base);
