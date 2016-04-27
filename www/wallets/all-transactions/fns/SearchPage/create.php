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
    list($keyword, $tag, $offset) = request_valid_keyword_tag_offset(
        $includes, $excludes, ['id' => $id]);

    include_once "$fnsDir/Paging/limit.php";
    $limit = \Paging\limit();

    include_once "$fnsDir/WalletTransactions/searchPageOnWallet.php";
    $transactions = \WalletTransactions\searchPageOnWallet(
        $mysqli, $id, $includes, $excludes, $offset, $limit, $total);

    include_once "$fnsDir/SearchForm/content.php";
    $formContent = "<input type=\"hidden\" name=\"id\" value=\"$id\" />"
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
    $deleteLink = \Page\imageLink('Delete All Transactions',
        "../delete-all/$escapedItemQuery", 'trash-bin', ['id' => 'delete-all']);

    include_once "$fnsDir/Page/panel.php";
    include_once "$fnsDir/Page/create.php";
    include_once "$fnsDir/Page/newItemButton.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    return
        \Page\create(
            [
                'title' => "Wallet #$id",
                'href' => "../../view/?id=$id#all-transactions",
            ],
            'All Transactions',
            \Page\sessionMessages('wallets/all-transactions/messages')
            .join('<div class="hr"></div>', $items),
            \Page\newItemButton("../new/$escapedItemQuery", 'Transaction')
        )
        .\Page\panel('Options', $deleteLink);

}
