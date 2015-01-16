<?php

function create_view_page ($mysqli, $wallet) {

    $fnsDir = __DIR__.'/../../fns';
    $id = $wallet->id;

    include_once "$fnsDir/date_ago.php";
    $infoText = 'Wallet created '.date_ago($wallet->insert_time).'.';
    if ($wallet->revision) {
        $infoText .= '<br />Last modified '.date_ago($wallet->update_time).'.';
    }

    include_once "$fnsDir/Page/imageArrowLink.php";
    $newTransactionLink = Page\imageArrowLink('New Transaction',
        "../new-transaction/?id=$id", 'create-transaction',
        ['id' => 'new-transaction']);

    $editLink = Page\imageArrowLink('Edit',
        "../edit/?id=$id", 'edit-wallet', ['id' => 'edit']);

    $deleteLink =
        '<div id="deleteLink">'
            .Page\imageArrowLink('Delete', "../delete/?id=$id", 'trash-bin')
        .'</div>';

    include_once "$fnsDir/Page/staticTwoColumns.php";
    $optionsContent =
        Page\staticTwoColumns($newTransactionLink, $editLink)
        .'<div class="hr"></div>'
        .$deleteLink;

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

        include_once "$fnsDir/WalletTransactions/indexOnWallet.php";
        $transactions = WalletTransactions\indexOnWallet($mysqli, $id);

        include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";
        $items = [];
        foreach ($transactions as $i => $transaction) {

            if ($i == $limit) break;

            $date = ucfirst(date_ago($transaction->insert_time));

            $description = $transaction->description;
            if ($description === '') $description = $date;
            else {
                $description = "$date &middot; ".htmlspecialchars($description);
            }

            $item_id = $transaction->id;
            $title = amount_html($transaction->amount);

            $items[] = Page\imageArrowLinkWithDescription($title,
                $description, "../view-transaction/?id=$item_id",
                'transaction', ['id' => $item_id]);

        }

        if ($num_transactions > $limit) {
            $items[] = Page\imageArrowLinkWithDescription('All Transactions',
                "$num_transactions total.", "../all-transactions/?id=$id",
                'transactions');
        }

        $transactionsContent = join('<div class="hr"></div>', $items);

    } else {
        include_once "$fnsDir/Page/info.php";
        $transactionsContent = Page\info('No transactions');
    }

    include_once "$fnsDir/create_new_item_button.php";
    include_once "$fnsDir/create_panel.php";
    include_once "$fnsDir/Form/label.php";
    include_once "$fnsDir/Page/infoText.php";
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
        create_new_item_button('Wallet', '../')
    );

}
