<?php

function create_view_page ($wallet) {

    $fnsDir = __DIR__.'/../../fns';
    $id = $wallet->id;

    include_once "$fnsDir/date_ago.php";
    $infoText = 'Wallet created '.date_ago($wallet->insert_time).'.';
    if ($wallet->revision) {
        $infoText .= '<br />Last modified '.date_ago($wallet->update_time).'.';
    }

    include_once "$fnsDir/Page/imageArrowLink.php";
    $editLink = Page\imageArrowLink('Edit',
        "../edit/?id=$id", 'TODO', ['id' => 'edit']);

    $deleteLink =
        '<div id="deleteLink">'
            .Page\imageArrowLink('Delete', "../delete/?id=$id", 'trash-bin')
        .'</div>';

    include_once "$fnsDir/Page/staticTwoColumns.php";
    $optionsContent = Page\staticTwoColumns($editLink, $deleteLink);

    unset(
        $_SESSION['wallets/errors'],
        $_SESSION['wallets/messages']
    );

    include_once "$fnsDir/create_panel.php";
    include_once "$fnsDir/Page/infoText.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    include_once "$fnsDir/Page/tabs.php";
    include_once "$fnsDir/Page/text.php";
    return Page\tabs(
        [
            [
                'title' => 'Wallets',
                'href' => "../#$id",
            ],
        ],
        "Wallet #$id",
        Page\sessionMessages('wallets/view/messages')
        .Page\text(htmlspecialchars($wallet->name))
        .Page\infoText($infoText)
        .create_panel('Wallet Options', $optionsContent)
    );

}
