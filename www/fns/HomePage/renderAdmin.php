<?php

namespace HomePage;

function renderAdmin ($user, &$items) {

    if (!$user->admin || !$user->show_admin) return;

    include_once __DIR__.'/../Page/thumbnailLink.php';
    $items['admin'] = \Page\thumbnailLink('Administration',
        '../admin/', 'administration', ['id' => 'admin']);

}
