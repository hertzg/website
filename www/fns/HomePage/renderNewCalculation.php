<?php

namespace HomePage;

function renderNewCalculation () {
    include_once __DIR__.'/../Page/thumbnailLink.php';
    return \Page\thumbnailLink('New Calculation',
        '../calculations/new/', 'create-calculation');
}
