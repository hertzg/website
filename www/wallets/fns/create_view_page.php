<?php

function create_view_page ($mysqli, $wallet) {

    $fnsDir = __DIR__.'/../../fns';
    $id = $wallet->id;

    include_once "$fnsDir/format_author.php";
    $author = format_author($wallet->insert_time, $wallet->insert_api_key_name);
    $infoText = "Wallet created $author.";
    if ($wallet->revision) {
        $author = format_author($wallet->update_time,
            $wallet->update_api_key_name);
        $infoText .= "<br />Last modified $author.";
    }

    include_once "$fnsDir/Page/imageArrowLink.php";
    $editLink = Page\imageArrowLink('Edit',
        "../edit/?id=$id", 'edit-wallet', ['id' => 'edit']);

    $deleteLink =
        '<div id="deleteLink">'
            .Page\imageArrowLink('Delete', "../delete/?id=$id", 'trash-bin')
        .'</div>';

    include_once "$fnsDir/Page/staticTwoColumns.php";
    $optionsContent = Page\staticTwoColumns($editLink, $deleteLink);

    unset(
        $_SESSION['wallets/edit/errors'],
        $_SESSION['wallets/edit/values'],
        $_SESSION['wallets/errors'],
        $_SESSION['wallets/messages'],
        $_SESSION['wallets/new-transaction/errors'],
        $_SESSION['wallets/new-transaction/values'],
        $_SESSION['wallets/view-transaction/messages']
    );

    include_once __DIR__.'/amount_html.php';

    $num_transactions = $wallet->num_transactions;
    if ($num_transactions) {

        $limit = 5;

        include_once "$fnsDir/WalletTransactions/indexLimitOnWallet.php";
        $transactions = WalletTransactions\indexLimitOnWallet(
            $mysqli, $id, $limit);

        include_once __DIR__.'/render_transactions.php';
        render_transactions($transactions, $items);

        if ($num_transactions > $limit) {
            $items[] = Page\imageArrowLinkWithDescription('All Transactions',
                "$num_transactions total.", "../all-transactions/?id=$id",
                'transactions', ['id' => 'all-transactions']);
        }

        $transactionsContent = join('<div class="hr"></div>', $items);

    } else {
        include_once "$fnsDir/Page/info.php";
        $transactionsContent = Page\info('No transactions');
    }

    include_once "$fnsDir/create_panel.php";
    include_once "$fnsDir/Form/label.php";
    include_once "$fnsDir/Page/infoText.php";
    include_once "$fnsDir/Page/newItemButton.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    include_once "$fnsDir/Page/tabs.php";
    return Page\tabs(
        [
            [
                'title' => 'Wallets',
                'href' => "../#$id",
            ],
        ],
        "Wallet #$id",
        Page\sessionMessages('wallets/view/messages')
        .Form\label('Name', htmlspecialchars($wallet->name))
        .'<div class="hr"></div>'
        .Form\label('Balance', amount_html($wallet->balance))
        .Page\infoText($infoText)
        .create_panel('Transactions', $transactionsContent)
        .create_panel('Wallet Options', $optionsContent),
        Page\newItemButton("../new-transaction/?id=$id", 'Transaction')
    );

}
