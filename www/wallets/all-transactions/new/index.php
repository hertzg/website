<?php

include_once '../../fns/require_wallet.php';
include_once '../../../lib/mysqli.php';
list($wallet, $id, $user) = require_wallet($mysqli, '../');

unset($_SESSION['wallets/all-transactions/messages']);

include_once '../../fns/request_new_transaction_values.php';
$values = request_new_transaction_values('wallets/all-transactions/new/values');

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
    'New',
    Page\sessionErrors('wallets/all-transactions/new/errors')
    .'<form action="submit.php" method="post">'
        .create_transaction_form_items($values)
        .'<div class="hr"></div>'
        .\Form\button('Save Transaction')
        .\Form\hidden('id', $id)
    .'</form>'
);

include_once "$fnsDir/echo_page.php";
echo_page($user, 'New Transaction', $content, $base);
