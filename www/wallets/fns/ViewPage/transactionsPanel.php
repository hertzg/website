<?php

namespace ViewPage;

function transactionsPanel ($mysqli, $wallet) {

    $id = $wallet->id;
    $fnsDir = __DIR__.'/../../../fns';

    $num_transactions = $wallet->num_transactions;
    if ($num_transactions) {

        $limit = 5;

        include_once "$fnsDir/WalletTransactions/indexLimitOnWallet.php";
        $transactions = \WalletTransactions\indexLimitOnWallet(
            $mysqli, $id, $limit);

        include_once __DIR__.'/../render_transactions.php';
        render_transactions($transactions, $items);

        if ($num_transactions > $limit) {
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
    return create_panel('Transactions', $content);

}
