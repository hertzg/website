<?php

include_once '../fns/require_wallet.php';
include_once '../../lib/mysqli.php';
list($wallet, $id, $user) = require_wallet($mysqli);

unset(
    $_SESSION['wallets/view/errors'],
    $_SESSION['wallets/view/messages']
);

include_once '../fns/request_new_transaction_values.php';
$values = request_new_transaction_values('wallets/new-transaction/values');

$base = '../../';
$fnsDir = '../../fns';

include_once '../fns/create_transaction_form_items.php';
include_once "$fnsDir/Form/button.php";
include_once "$fnsDir/ItemList/escapedItemQuery.php";
include_once "$fnsDir/ItemList/itemHiddenInputs.php";
include_once "$fnsDir/Page/sessionErrors.php";
include_once "$fnsDir/Page/tabs.php";
$content = Page\tabs(
    [
        [
            'title' => "Wallet #$id",
            'href' => '../view/'.ItemList\escapedItemQuery($id),
        ]
    ],
    'Add New Transaction',
    Page\sessionErrors('wallets/new-transaction/errors')
    .'<form action="submit.php" method="post">'
        .create_transaction_form_items($values)
        .'<div class="hr"></div>'
        .Form\button('Save Transaction')
        .ItemList\itemHiddenInputs($id)
    .'</form>'
);

include_once "$fnsDir/echo_page.php";
echo_page($user, "Add New Transaction to Wallet #$wallet->id", $content, $base);
