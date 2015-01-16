<?php

function create_view_page ($transaction) {

    $fnsDir = __DIR__.'/../../fns';
    $id = $transaction->id;
    $id_wallets = $transaction->id_wallets;

    include_once "$fnsDir/date_ago.php";
    $infoText = 'Transaction created '.date_ago($transaction->insert_time).'.';
    if ($transaction->revision) {
        $infoText .= '<br />Last modified '.date_ago($transaction->update_time).'.';
    }

    include_once "$fnsDir/Page/imageArrowLink.php";
    $editLink = Page\imageArrowLink('Edit',
        "../edit-transaction/?id=$id", 'edit-transaction', ['id' => 'edit']);

    include_once "$fnsDir/Page/imageLink.php";
    $deleteLink =
        '<div id="deleteLink">'
            .Page\imageLink('Delete',
                "../delete-transaction/?id=$id", 'trash-bin')
        .'</div>';

    include_once "$fnsDir/Page/staticTwoColumns.php";
    $optionsContent = Page\staticTwoColumns($editLink, $deleteLink);

    unset(
        $_SESSION['wallets/edit-transaction/errors'],
        $_SESSION['wallets/edit-transaction/values'],
        $_SESSION['wallets/view/messages']
    );

    include_once __DIR__.'/amount_html.php';
    include_once "$fnsDir/Form/label.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    $content =
        Page\sessionMessages('wallets/view-transaction/messages')
        .Form\label('Amount', amount_html($transaction->amount));

    $description = $transaction->description;
    if ($description !== '') {
        $content .=
            '<div class="hr"></div>'
            .Form\label('Description', htmlspecialchars($description));
    }

    include_once "$fnsDir/Page/infoText.php";
    include_once "$fnsDir/create_panel.php";
    include_once "$fnsDir/Page/tabs.php";
    return Page\tabs(
        [
            [
                'title' => "Wallet #$id_wallets",
                'href' => "../view/?id=$id_wallets#$id",
            ],
        ],
        "Transaction #$id",
        $content
        .Page\infoText($infoText)
        .create_panel('Transaction Options', $optionsContent)
    );

}
