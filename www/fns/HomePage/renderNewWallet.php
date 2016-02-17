<?php

namespace HomePage;

function renderNewWallet () {
    include_once __DIR__.'/../Page/thumbnailLink.php';
    return \Page\thumbnailLink('New Wallet',
        '../wallets/new/', 'create-wallet');
}
