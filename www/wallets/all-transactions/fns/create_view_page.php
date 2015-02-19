<?php

function create_view_page ($transaction) {

    $fnsDir = __DIR__.'/../../../fns';
    $id = $transaction->id;
    $id_wallets = $transaction->id_wallets;

    include_once "$fnsDir/ItemList/escapedItemQuery.php";
    $escapedItemQuery = ItemList\escapedItemQuery($id);
    $walletEscapedItemQuery = ItemList\escapedItemQuery($id_wallets);

    include_once "$fnsDir/Page/imageArrowLink.php";
    $editLink = Page\imageArrowLink('Edit',
        "../edit/$escapedItemQuery", 'edit-transaction', ['id' => 'edit']);

    include_once "$fnsDir/Page/imageLink.php";
    $deleteLink =
        '<div id="deleteLink">'
            .Page\imageLink('Delete',
                "../delete/$escapedItemQuery", 'trash-bin')
        .'</div>';

    include_once "$fnsDir/Page/staticTwoColumns.php";
    $optionsContent = Page\staticTwoColumns($editLink, $deleteLink);

    unset(
        $_SESSION['wallets/all-transactions/edit/errors'],
        $_SESSION['wallets/all-transactions/edit/values'],
        $_SESSION['wallets/all-transactions/messages'],
        $_SESSION['wallets/view/messages']
    );

    include_once __DIR__.'/../../fns/ViewTransactionPage/viewContent.php';
    include_once "$fnsDir/create_panel.php";
    include_once "$fnsDir/Page/infoText.php";
    include_once "$fnsDir/Page/newItemButton.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    include_once "$fnsDir/Page/tabs.php";
    return Page\tabs(
        [
            [
                'title' => 'All Transactions',
                'href' => "../$walletEscapedItemQuery#$id",
            ],
        ],
        "Transaction #$id",
        Page\sessionMessages('wallets/all-transactions/view/messages')
        .ViewTransactionPage\viewContent($transaction)
        .create_panel('Transaction Options', $optionsContent),
        Page\newItemButton("../new/$walletEscapedItemQuery", 'Transaction')
    );

}
