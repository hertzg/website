<?php

namespace HomePage;

function renderNewSchedule () {
    include_once __DIR__.'/../Page/thumbnailLink.php';
    return \Page\thumbnailLink('New Schedule',
        '../schedules/new/', 'create-schedule');
}
