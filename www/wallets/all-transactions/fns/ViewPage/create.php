<?php

namespace ViewPage;

function create ($transaction, &$scripts) {

    $fnsDir = __DIR__.'/../../../../fns';
    $id = $transaction->id;
    $id_wallets = $transaction->id_wallets;

    include_once "$fnsDir/request_strings.php";
    list($keyword) = request_strings('keyword');

    include_once "$fnsDir/str_collapse_spaces.php";
    $keyword = str_collapse_spaces($keyword);

    if ($keyword === '') {
        $dir = __DIR__.'/../../../fns';
        include_once "$dir/ViewTransactionPage/viewContent.php";
        $viewContent = \ViewTransactionPage\viewContent(
            $transaction, $scripts, '../');
    } else {
        include_once __DIR__.'/markedViewContent.php';
        $viewContent = markedViewContent($transaction, $scripts, $keyword);
    }

     include_once "$fnsDir/ItemList/escapedItemQuery.php";
    $escapedItemQuery = \ItemList\escapedItemQuery($id);

    include_once "$fnsDir/Page/imageArrowLink.php";
    $editLink = \Page\imageArrowLink('Edit',
        "../edit/$escapedItemQuery", 'edit-transaction', ['id' => 'edit']);

    $params = [
        'id' => $id_wallets,
        'amount' => $transaction->amount,
    ];
    $description = $transaction->description;
    if ($description !== '') $params['description'] = $description;
    $href = '../new/?'.htmlspecialchars(http_build_query($params));
    $duplicateLink = \Page\imageArrowLink(
        'Duplicate', $href, 'duplicate-transaction');

    include_once "$fnsDir/Page/imageLink.php";
    $deleteLink =
        '<div id="deleteLink">'
            .\Page\imageLink('Delete',
                "../delete/$escapedItemQuery", 'trash-bin')
        .'</div>';

    include_once "$fnsDir/Page/staticTwoColumns.php";
    $optionsContent =
        \Page\staticTwoColumns($editLink, $duplicateLink)
        .'<div class="hr"></div>'
        .$deleteLink;

    unset(
        $_SESSION['wallets/all-transactions/edit/errors'],
        $_SESSION['wallets/all-transactions/edit/values'],
        $_SESSION['wallets/all-transactions/messages']
    );

    include_once "$fnsDir/ItemList/listHref.php";
    $listHref = \ItemList\listHref('', ['id' => $id_wallets]);

    include_once "$fnsDir/create_panel.php";
    include_once "$fnsDir/Page/newItemButton.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    include_once "$fnsDir/Page/tabs.php";
    return \Page\tabs(
        [
            [
                'title' => 'All Transactions',
                'href' => "../$listHref#$id",
            ],
        ],
        "Transaction #$id",
        \Page\sessionMessages('wallets/all-transactions/view/messages')
        .$viewContent
        .create_panel('Transaction Options', $optionsContent),
        \Page\newItemButton(
            '../new/'.\ItemList\escapedItemQuery($id_wallets), 'Transaction')
    );

}