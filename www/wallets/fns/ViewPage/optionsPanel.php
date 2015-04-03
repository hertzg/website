<?php

namespace ViewPage;

function optionsPanel ($id, $user) {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/Page/imageArrowLink.php";
    $editLink = \Page\imageArrowLink('Edit',
        "../edit/?id=$id", 'edit-wallet', ['id' => 'edit']);

    $deleteLink =
        '<div id="deleteLink">'
            .\Page\imageArrowLink('Delete', "../delete/?id=$id", 'trash-bin')
        .'</div>';

    include_once "$fnsDir/Page/staticTwoColumns.php";
    if ($user->num_wallets > 1) {

        $transferAmountLink = \Page\imageArrowLink('Transfer Amount',
            "../transfer-amount/?id=$id", 'transfer-amount',
            ['id' => 'transfer-amount']);

        $content =
            \Page\staticTwoColumns($editLink, $transferAmountLink)
            .'<div class="hr"></div>'
            .$deleteLink;

    } else {
        $content = \Page\staticTwoColumns($editLink, $deleteLink);
    }

    include_once "$fnsDir/create_panel.php";
    return create_panel('Wallet Options', $content);

}
