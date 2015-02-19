<?php

function create_view_page ($transaction) {

    $fnsDir = __DIR__.'/../../../fns';
    $id = $transaction->id;
    $id_wallets = $transaction->id_wallets;

    include_once "$fnsDir/format_author.php";
    $author = format_author($transaction->insert_time,
        $transaction->insert_api_key_name);
    $infoText = "Transaction created $author.";
    if ($transaction->revision) {
        $author = format_author($transaction->update_time,
            $transaction->update_api_key_name);
        $infoText .= "<br />Last modified $author.";
    }

    include_once "$fnsDir/Page/imageArrowLink.php";
    $editLink = Page\imageArrowLink('Edit',
        "../edit/?id=$id", 'edit-transaction', ['id' => 'edit']);

    include_once "$fnsDir/Page/imageLink.php";
    $deleteLink =
        '<div id="deleteLink">'
            .Page\imageLink('Delete', "../delete/?id=$id", 'trash-bin')
        .'</div>';

    include_once "$fnsDir/Page/staticTwoColumns.php";
    $optionsContent = Page\staticTwoColumns($editLink, $deleteLink);

    unset(
        $_SESSION['wallets/all-transactions/edit/errors'],
        $_SESSION['wallets/all-transactions/edit/values'],
        $_SESSION['wallets/all-transactions/messages'],
        $_SESSION['wallets/view/messages']
    );

    include_once __DIR__.'/../../fns/amount_html.php';
    include_once "$fnsDir/Form/label.php";
    include_once "$fnsDir/Page/newItemButton.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    $content =
        Page\sessionMessages('wallets/all-transactions/view/messages')
        .Form\label('Amount', amount_html($transaction->amount));

    $description = $transaction->description;
    if ($description !== '') {
        $content .=
            '<div class="hr"></div>'
            .Form\label('Description', htmlspecialchars($description));
    }

    $content .=
        '<div class="hr"></div>'
        .Form\label('Balance after', amount_html($transaction->balance_after));

    include_once "$fnsDir/Page/infoText.php";
    include_once "$fnsDir/create_panel.php";
    include_once "$fnsDir/Page/tabs.php";
    return Page\tabs(
        [
            [
                'title' => 'All Transactions',
                'href' => "../?id=$id_wallets#$id",
            ],
        ],
        "Transaction #$id",
        $content
        .Page\infoText($infoText)
        .create_panel('Transaction Options', $optionsContent),
        Page\newItemButton("../new/?id=$id_wallets", 'Transaction')
    );

}
