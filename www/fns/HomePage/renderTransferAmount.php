<?php

namespace HomePage;

function renderTransferAmount () {
    include_once __DIR__.'/../Page/thumbnailLink.php';
    return \Page\thumbnailLink('Transfer Amount',
        '../wallets/quick-transfer-amount/', 'transfer-amount',
        ['localNavigation' => true]);
}
