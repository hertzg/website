<?php

namespace ViewTransactionPage;

function create ($transaction) {

    $fnsDir = __DIR__.'/../../../fns';
    $id = $transaction->id;
    $id_wallets = $transaction->id_wallets;

    include_once "$fnsDir/Page/imageArrowLink.php";
    $editLink = \Page\imageArrowLink('Edit',
        "../edit-transaction/?id=$id", 'edit-transaction', ['id' => 'edit']);

    include_once "$fnsDir/Page/imageLink.php";
    $deleteLink =
        '<div id="deleteLink">'
            .\Page\imageLink('Delete',
                "../delete-transaction/?id=$id", 'trash-bin')
        .'</div>';

    include_once "$fnsDir/Page/staticTwoColumns.php";
    $optionsContent = \Page\staticTwoColumns($editLink, $deleteLink);

    unset(
        $_SESSION['wallets/edit-transaction/errors'],
        $_SESSION['wallets/edit-transaction/values'],
        $_SESSION['wallets/view/messages']
    );

    include_once __DIR__.'/viewContent.php';
    include_once "$fnsDir/create_panel.php";
    include_once "$fnsDir/Page/newItemButton.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    include_once "$fnsDir/Page/tabs.php";
    return \Page\tabs(
        [
            [
                'title' => "Wallet #$id_wallets",
                'href' => "../view/?id=$id_wallets#$id",
            ],
        ],
        "Transaction #$id",
        \Page\sessionMessages('wallets/view-transaction/messages')
        .viewContent($transaction)
        .create_panel('Transaction Options', $optionsContent),
        \Page\newItemButton("../new-transaction/?id=$id_wallets", 'Transaction')
    );

}
