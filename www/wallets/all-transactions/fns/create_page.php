<?php

function create_page ($mysqli, $user, $wallet, &$scripts, $base = '') {

    $id = $wallet->id;
    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/compressed_js_script.php";
    $scripts = compressed_js_script('dateAgo', "$base../../");

    include_once "$fnsDir/Paging/requestOffset.php";
    $offset = Paging\requestOffset("?id=$id");

    include_once "$fnsDir/Paging/limit.php";
    $limit = Paging\limit();

    include_once "$fnsDir/WalletTransactions/indexPageOnWallet.php";
    $transactions = WalletTransactions\indexPageOnWallet(
        $mysqli, $id, $offset, $limit, $total);

    $items = [];

    if ($wallet->num_transactions > 1) {

        include_once "$fnsDir/SearchForm/emptyContent.php";
        $formContent = "<input type=\"hidden\" name=\"id\" value=\"$id\" />"
            .SearchForm\emptyContent('Search transactions...');

        include_once "$fnsDir/SearchForm/create.php";
        $items[] = SearchForm\create("{$base}search/", $formContent);

        $scripts .= compressed_js_script('searchForm', "$base../../");

    }

    $params = ['id' => $id];

    include_once "$fnsDir/check_offset_overflow.php";
    check_offset_overflow($offset, $limit, $total, $params);

    include_once __DIR__.'/render_prev_button.php';
    render_prev_button($offset, $limit, $total, $items, $params);

    include_once __DIR__.'/render_transactions.php';
    render_transactions($transactions, $items, $base);

    include_once __DIR__.'/render_next_button.php';
    render_next_button($offset, $limit, $total, $items, $params);

    unset(
        $_SESSION['wallets/all-transactions/new/errors'],
        $_SESSION['wallets/all-transactions/new/values'],
        $_SESSION['wallets/all-transactions/view/messages'],
        $_SESSION['wallets/view/errors'],
        $_SESSION['wallets/view/messages']
    );

    include_once "$fnsDir/ItemList/escapedItemQuery.php";
    $escapedItemQuery = ItemList\escapedItemQuery($id);

    include_once "$fnsDir/Page/imageLink.php";
    $deleteLink = Page\imageLink('Delete All Transactions',
        "{$base}delete-all/$escapedItemQuery",
        'trash-bin', ['id' => 'delete-all']);

    include_once "$fnsDir/create_panel.php";
    include_once "$fnsDir/Page/create.php";
    include_once "$fnsDir/Page/newItemButton.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    return
        Page\create(
            [
                'title' => "Wallet #$id",
                'href' => "$base../view/?id=$id#all-transactions",
            ],
            'All Transactions',
            Page\sessionMessages('wallets/all-transactions/messages')
            .join('<div class="hr"></div>', $items),
            Page\newItemButton("{$base}new/$escapedItemQuery", 'Transaction')
        )
        .create_panel('Options', $deleteLink);

}
