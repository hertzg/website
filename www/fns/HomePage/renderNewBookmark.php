<?php

namespace HomePage;

function renderNewBookmark () {
    include_once __DIR__.'/../Page/thumbnailLink.php';
    return \Page\thumbnailLink('New Bookmark',
        '../bookmarks/new/', 'create-bookmark');
}
