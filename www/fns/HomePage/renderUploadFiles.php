<?php

namespace HomePage;

function renderUploadFiles () {
    include_once __DIR__.'/../Page/thumbnailLink.php';
    return \Page\thumbnailLink('Upload Files',
        '../files/upload-files/', 'upload');
}
