<?php

namespace HomePage;

function renderNewTransaction () {
    include_once __DIR__.'/../Page/thumbnailLink.php';
    return \Page\thumbnailLink('New Transaction',
        '../wallets/quick-new-transaction/', 'create-transaction',
        ['localNavigation' => true]);
}
