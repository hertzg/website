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

    include_once "$fnsDir/amount_text.php";
    $params = [
        'id' => $id_wallets,
        'amount' => amount_text($transaction->amount, ''),
    ];
    $description = $transaction->description;
    if ($description !== '') $params['description'] = $description;
    $href = '../new/?'.htmlspecialchars(http_build_query($params));
    $duplicateLink = \Page\imageArrowLink(
        'Duplicate', $href, 'duplicate-transaction');

    include_once "$fnsDir/Page/imageLink.php";
    include_once "$fnsDir/Page/staticTwoColumns.php";
    $optionsContent =
        \Page\staticTwoColumns($editLink, $duplicateLink)
        .'<div class="hr"></div>'
        .\Page\imageLink('Delete', "../delete/$escapedItemQuery",
            'trash-bin', ['id' => 'delete']);

    unset(
        $_SESSION['wallets/all-transactions/edit/errors'],
        $_SESSION['wallets/all-transactions/edit/values'],
        $_SESSION['wallets/all-transactions/messages'],
        $_SESSION['wallets/all-transactions/new/errors'],
        $_SESSION['wallets/all-transactions/new/values']
    );

    include_once "$fnsDir/ItemList/listHref.php";
    $listHref = \ItemList\listHref('', ['id' => $id_wallets]);

    include_once "$fnsDir/Page/panel.php";
    include_once "$fnsDir/Page/create.php";
    include_once "$fnsDir/Page/newItemButton.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    return
        \Page\create(
            [
                'title' => 'All Transactions',
                'href' => "../$listHref#$id",
            ],
            "Transaction #$id",
            \Page\sessionMessages('wallets/all-transactions/view/messages')
            .$viewContent,
            \Page\newItemButton(
                '../new/'.\ItemList\escapedItemQuery($id_wallets),
                'Transaction')
        )
        .\Page\panel('Transaction Options', $optionsContent);

}
