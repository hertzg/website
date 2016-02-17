<?php

namespace HomePage;

function renderNewPlace () {
    include_once __DIR__.'/../Page/thumbnailLink.php';
    return \Page\thumbnailLink('New Place', '../places/new/', 'create-place');
}
