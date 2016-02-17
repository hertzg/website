<?php

namespace HomePage;

function renderPostNotification () {
    include_once __DIR__.'/../Page/thumbnailLink.php';
    return \Page\thumbnailLink('Post a Notification',
        '../notifications/post/', 'create-notification');
}
