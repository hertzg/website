<?php

namespace HomePage;

function renderNewEvent () {
    include_once __DIR__.'/../Page/thumbnailLink.php';
    return \Page\thumbnailLink('New Event',
        '../calendar/new-event/', 'create-event');
}
