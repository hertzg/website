<?php

namespace ViewPage;

function optionsPanel ($wallet, $user) {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/ItemList/escapedItemQuery.php";
    $escapedItemQuery = \ItemList\escapedItemQuery($wallet->id);

    include_once "$fnsDir/Page/imageArrowLink.php";
    $editLink = \Page\imageArrowLink('Edit',
        "../edit/$escapedItemQuery", 'edit-wallet', ['id' => 'edit']);

    $deleteLink = \Page\imageArrowLink('Delete',
        "../delete/$escapedItemQuery", 'trash-bin', ['id' => 'delete']);

    include_once "$fnsDir/Page/staticTwoColumns.php";
    $content = \Page\staticTwoColumns($editLink, $deleteLink);

    if ($user->num_wallets > 1) {
        $content =
            \Page\imageArrowLink('Transfer Amount',
                "../transfer-amount/$escapedItemQuery",
                'transfer-amount', ['id' => 'transfer-amount'])
            .'<div class="hr"></div>'
            .$content;
    }

    include_once "$fnsDir/Page/panel.php";
    return \Page\panel('Wallet Options', $content);

}
