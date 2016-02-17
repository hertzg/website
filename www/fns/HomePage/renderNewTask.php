<?php

namespace HomePage;

function renderNewTask () {
    include_once __DIR__.'/../Page/thumbnailLink.php';
    return \Page\thumbnailLink('New Task', '../tasks/new/', 'create-task');
}
