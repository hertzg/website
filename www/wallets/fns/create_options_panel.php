<?php

function create_options_panel ($user, $base = '') {

    $num_wallets = $user->num_wallets;
    if (!$num_wallets) return;

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/ItemList/escapedPageQuery.php";
    $escapedPageQuery = ItemList\escapedPageQuery();

    include_once "$fnsDir/Page/imageArrowLink.php";
    $newTransactionLink = Page\imageArrowLink('New Transaction',
        "{$base}quick-new-transaction/$escapedPageQuery",
        'create-transaction', [
            'id' => 'new-transaction',
            'localNavigation' => true,
        ]
    );

    if ($num_wallets > 1) {

        $transferAmountLink = Page\imageArrowLink('Transfer Amount',
            "{$base}quick-transfer-amount/$escapedPageQuery",
            'transfer-amount', ['id' => 'transfer-amount']);

        include_once "$fnsDir/Page/twoColumns.php";
        $content = Page\twoColumns($newTransactionLink, $transferAmountLink);

    } else {
        $content = $newTransactionLink;
    }

    include_once "$fnsDir/Page/imageLink.php";
    $content .=
        '<div class="hr"></div>'
        .'<div id="deleteAllLink">'
            .Page\imageLink('Delete All Wallets',
                "{$base}delete-all/$escapedPageQuery", 'trash-bin')
        .'</div>';

    include_once "$fnsDir/create_panel.php";
    return create_panel('Options', $content);

}
