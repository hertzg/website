<?php

include_once '../fns/require_transaction.php';
include_once '../../lib/mysqli.php';
list($transaction, $id, $user) = require_transaction($mysqli);

$fnsDir = '../../fns';

include_once '../fns/request_edit_transaction_values.php';
$values = request_edit_transaction_values($transaction,
    'wallets/edit-transaction/values');

unset($_SESSION['wallets/view-transaction/messages']);

include_once '../fns/create_transaction_form_items.php';
include_once "$fnsDir/Form/button.php";
include_once "$fnsDir/Form/hidden.php";
include_once "$fnsDir/Page/sessionErrors.php";
include_once "$fnsDir/Page/tabs.php";
$content = Page\tabs(
    [
        [
            'title' => "Transaction #$id",
            'href' => "../view-transaction/?id=$id#edit",
        ],
    ],
    'Edit',
    Page\sessionErrors('wallets/edit-transaction/errors')
    .'<form action="submit.php" method="post">'
        .create_transaction_form_items($values)
        .'<div class="hr"></div>'
        .Form\button('Save Changes')
        .Form\hidden('id', $id)
    .'</form>'
);

include_once "$fnsDir/echo_page.php";
echo_page($user, "Edit Transaction #$id", $content, '../../');
