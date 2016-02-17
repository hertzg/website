<?php

namespace HomePage;

function renderNewBarChart () {
    include_once __DIR__.'/../Page/thumbnailLink.php';
    return \Page\thumbnailLink('New Bar Chart',
        '../bar-charts/new/', 'create-bar-chart');
}
