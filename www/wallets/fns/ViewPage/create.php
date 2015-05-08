<?php

namespace ViewPage;

function create ($mysqli, $user, $wallet, &$scripts) {

    $fnsDir = __DIR__.'/../../../fns';
    $id = $wallet->id;
    $income = $wallet->income;
    $expense = $wallet->expense;

    include_once "$fnsDir/compressed_js_script.php";
    $scripts = compressed_js_script('dateAgo', '../../');

    include_once "$fnsDir/format_author.php";
    $author = format_author($wallet->insert_time, $wallet->insert_api_key_name);
    $infoText = "Wallet created $author.";
    if ($wallet->revision) {
        $author = format_author($wallet->update_time,
            $wallet->update_api_key_name);
        $infoText .= "<br />Last modified $author.";
    }

    unset(
        $_SESSION['wallets/all-transactions/messages'],
        $_SESSION['wallets/edit/errors'],
        $_SESSION['wallets/edit/values'],
        $_SESSION['wallets/errors'],
        $_SESSION['wallets/messages'],
        $_SESSION['wallets/new-transaction/errors'],
        $_SESSION['wallets/new-transaction/values'],
        $_SESSION['wallets/transfer-amount/errors'],
        $_SESSION['wallets/transfer-amount/values'],
        $_SESSION['wallets/view-transaction/messages']
    );

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

        $transactionsContent = join('<div class="hr"></div>', $items);

    } else {
        include_once "$fnsDir/Page/info.php";
        $transactionsContent = \Page\info('No transactions');
    }

    $days = (time() - $wallet->insert_time) / (60 * 60 * 24);
    if ($days < 1) $days = 1;

    include_once "$fnsDir/amount_html.php";
    $income = amount_html($income).' ('.amount_html($income / $days).' daily)';
    $expense = amount_html($expense)
        .' ('.amount_html($expense / $days).' daily)';

    include_once __DIR__.'/optionsPanel.php';
    include_once "$fnsDir/create_panel.php";
    include_once "$fnsDir/Form/label.php";
    include_once "$fnsDir/Page/infoText.php";
    include_once "$fnsDir/Page/newItemButton.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    include_once "$fnsDir/Page/tabs.php";
    return \Page\tabs(
        [
            [
                'title' => 'Wallets',
                'href' => "../#$id",
            ],
        ],
        "Wallet #$id",
        \Page\sessionMessages('wallets/view/messages')
        .\Form\label('Name', htmlspecialchars($wallet->name))
        .'<div class="hr"></div>'
        .\Form\label('Income', $income)
        .'<div class="hr"></div>'
        .\Form\label('Expense', $expense)
        .'<div class="hr"></div>'
        .\Form\label('Balance', amount_html($wallet->balance))
        .\Page\infoText($infoText)
        .create_panel('Transactions', $transactionsContent)
        .optionsPanel($id, $user),
        \Page\newItemButton("../new-transaction/?id=$id", 'Transaction')
    );

}
