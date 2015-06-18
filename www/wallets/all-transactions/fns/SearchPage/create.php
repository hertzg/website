<?php

namespace SearchPage;

function create ($mysqli, $user, $wallet, &$scripts) {

    $id = $wallet->id;
    $base = '../../../';
    $fnsDir = __DIR__.'/../../../../fns';

    include_once "$fnsDir/compressed_js_script.php";
    $scripts = compressed_js_script('dateAgo', $base)
        .compressed_js_script('searchForm', $base);

    include_once "$fnsDir/request_valid_keyword_tag_offset.php";
    list($keyword, $tag, $offset) = request_valid_keyword_tag_offset([
        'id' => $id,
    ]);

    include_once "$fnsDir/Paging/limit.php";
    $limit = \Paging\limit();

    include_once "$fnsDir/WalletTransactions/searchPageOnWallet.php";
    $transactions = \WalletTransactions\searchPageOnWallet(
        $mysqli, $id, $keyword, $offset, $limit, $total);

    include_once "$fnsDir/Form/hidden.php";
    include_once "$fnsDir/SearchForm/content.php";
    $formContent = \Form\hidden('id', $id)
        .\SearchForm\content($keyword, 'Search transactions...', "../?id=$id");

    include_once "$fnsDir/SearchForm/create.php";
    $items = [\SearchForm\create('./', $formContent)];

    $params = [
        'id' => $id,
        'keyword' => $keyword,
    ];

    include_once "$fnsDir/check_offset_overflow.php";
    check_offset_overflow($offset, $limit, $total, $params);

    include_once __DIR__.'/../render_prev_button.php';
    render_prev_button($offset, $limit, $total, $items, $params);

    include_once __DIR__.'/renderTransactions.php';
    renderTransactions($transactions, $items, $keyword);

    include_once __DIR__.'/../render_next_button.php';
    render_next_button($offset, $limit, $total, $items, $params);

    unset(
        $_SESSION['wallets/all-transactions/new/errors'],
        $_SESSION['wallets/all-transactions/new/values'],
        $_SESSION['wallets/all-transactions/view/messages'],
        $_SESSION['wallets/view/errors'],
        $_SESSION['wallets/view/messages']
    );

    include_once "$fnsDir/ItemList/escapedItemQuery.php";
    $escapedItemQuery = \ItemList\escapedItemQuery($id);

    include_once "$fnsDir/Page/imageLink.php";
    $deleteLink =
        '<div id="deleteAllLink">'
            .\Page\imageLink('Delete All Transactions',
                "../delete-all/$escapedItemQuery", 'trash-bin')
        .'</div>';

    include_once "$fnsDir/create_panel.php";
    include_once "$fnsDir/Page/newItemButton.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    include_once "$fnsDir/Page/tabs.php";
    return \Page\tabs(
        [
            [
                'title' => "Wallet #$id",
                'href' => "../../view/?id=$id#all-transactions",
            ],
        ],
        'All Transactions',
        \Page\sessionMessages('wallets/all-transactions/messages')
        .join('<div class="hr"></div>', $items)
        .create_panel('Options', $deleteLink),
        \Page\newItemButton("../new/$escapedItemQuery", 'Transaction')
    );

}
