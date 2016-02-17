<?php

namespace HomePage;

function renderNewNote () {
    include_once __DIR__.'/../Page/thumbnailLink.php';
    return \Page\thumbnailLink('New Note', '../notes/new/', 'create-note');
}
