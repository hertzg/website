<?php

namespace ViewPage;

function transactionsPanel ($mysqli, $wallet, &$scripts) {

    $id = $wallet->id;
    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/ItemList/escapedItemQuery.php";
    include_once "$fnsDir/Page/newItemButton.php";
    $newItemButton = \Page\newItemButton(
        '../new-transaction/'.\ItemList\escapedItemQuery($id),
        'Transaction', !$wallet->num_transactions);

    $num_transactions = $wallet->num_transactions;
    if ($num_transactions) {

        $limit = 5;

        if ($num_transactions > $limit) {

            include_once "$fnsDir/SearchForm/emptyContent.php";
            $content = "<input type=\"hidden\" name=\"id\" value=\"$id\" />"
                .\SearchForm\emptyContent('Search transactions...');

            include_once "$fnsDir/SearchForm/create.php";
            $items[] = \SearchForm\create(
                '../all-transactions/search/', $content);

            include_once "$fnsDir/compressed_js_script.php";
            $scripts .= compressed_js_script('searchForm', '../../');

        }

        include_once "$fnsDir/WalletTransactions/indexLimitOnWallet.php";
        $transactions = \WalletTransactions\indexLimitOnWallet(
            $mysqli, $id, $limit);

        include_once __DIR__.'/../render_transactions.php';
        render_transactions($transactions, $items);

        if ($num_transactions > $limit) {
            include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";
            $items[] = \Page\imageArrowLinkWithDescription('All Transactions',
                "$num_transactions total.", "../all-transactions/?id=$id",
                'transactions', ['id' => 'all-transactions']);
        }

        $content = join('<div class="hr"></div>', $items);

    } else {
        include_once "$fnsDir/Page/info.php";
        $content = \Page\info('No transactions');
    }

    include_once "$fnsDir/create_panel.php";
    return create_panel('Transactions', $content, $newItemButton);

}
