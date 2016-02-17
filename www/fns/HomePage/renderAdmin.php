<?php

namespace HomePage;

function renderAdmin () {
    include_once __DIR__.'/../Page/thumbnailLink.php';
    return \Page\thumbnailLink('Administration',
        '../admin/', 'administration', ['id' => 'admin']);
}
