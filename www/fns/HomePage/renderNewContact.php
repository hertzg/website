<?php

namespace HomePage;

function renderNewContact () {
    include_once __DIR__.'/../Page/thumbnailLink.php';
    return \Page\thumbnailLink('New Contact',
        '../contacts/new/', 'create-contact');
}
