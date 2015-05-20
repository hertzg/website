<?php

namespace ViewTransactionPage;

function create ($transaction, &$scripts) {

    $fnsDir = __DIR__.'/../../../fns';
    $id = $transaction->id;
    $id_wallets = $transaction->id_wallets;

    include_once "$fnsDir/ItemList/escapedItemQuery.php";
    $escapedItemQuery = \ItemList\escapedItemQuery($id);
    $walletEscapedItemQuery = \ItemList\escapedItemQuery($id_wallets);

    include_once "$fnsDir/Page/imageArrowLink.php";
    $editLink = \Page\imageArrowLink('Edit',
        "../edit-transaction/$escapedItemQuery", 'edit-transaction', ['id' => 'edit']);

    include_once "$fnsDir/amount_text.php";
    $params = [
        'id' => $id_wallets,
        'amount' => amount_text($transaction->amount),
    ];
    $description = $transaction->description;
    if ($description !== '') $params['description'] = $description;
    $href = '../new-transaction/?'.htmlspecialchars(http_build_query($params));
    $duplicateLink = \Page\imageArrowLink(
        'Duplicate', $href, 'duplicate-transaction');

    include_once "$fnsDir/Page/imageLink.php";
    $deleteLink =
        '<div id="deleteLink">'
            .\Page\imageLink('Delete',
                "../delete-transaction/$escapedItemQuery", 'trash-bin')
        .'</div>';

    include_once "$fnsDir/Page/staticTwoColumns.php";
    $optionsContent =
        \Page\staticTwoColumns($editLink, $duplicateLink)
        .'<div class="hr"></div>'
        .$deleteLink;

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
                'href' => "../view/$walletEscapedItemQuery#$id",
            ],
        ],
        "Transaction #$id",
        \Page\sessionMessages('wallets/view-transaction/messages')
        .viewContent($transaction, $scripts)
        .create_panel('Transaction Options', $optionsContent),
        \Page\newItemButton(
            "../new-transaction/$walletEscapedItemQuery", 'Transaction')
    );

}
