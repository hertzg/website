<?php

namespace ViewPage;

function renderWallet ($wallet, &$items) {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/Form/label.php";
    $items[] = \Form\label('Name', htmlspecialchars($wallet->name));

    include_once "$fnsDir/amount_html.php";
    $items[] = \Form\label('Balance', amount_html($wallet->balance));

}
