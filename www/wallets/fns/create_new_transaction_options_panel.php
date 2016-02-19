<?php

function create_new_transaction_options_panel ($user, $base = '') {

    if ($user->num_wallets <= 1) return;

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/Page/imageLinkWithDescription.php";
    $link = Page\imageLinkWithDescription('New Transaction',
        'In another wallet', "$base../quick-new-transaction/",
        'create-transaction', ['localNavigation' => true]);

    include_once "$fnsDir/create_panel.php";
    return create_panel('Options', $link);

}
