<?php

function create_options_panel ($user, $base = '') {

    if (!$user->num_wallets) return;

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/ItemList/escapedPageQuery.php";
    $escapedPageQuery = ItemList\escapedPageQuery();

    include_once "$fnsDir/Page/imageArrowLink.php";
    include_once "$fnsDir/Page/imageLink.php";
    $content =
        Page\imageArrowLink('New Transaction',
            "{$base}quick-new-transaction/$escapedPageQuery",
            'create-transaction', ['id' => 'new-transaction'])
        .'<div class="hr"></div>'
        .'<div id="deleteAllLink">'
            .Page\imageLink('Delete All Wallets',
                "{$base}delete-all/$escapedPageQuery", 'trash-bin')
        .'</div>';

    include_once "$fnsDir/create_panel.php";
    return create_panel('Options', $content);

}
