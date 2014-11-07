<?php

namespace ContactPhotos;

function dir () {
    include_once __DIR__.'/../get_data_dir.php';
    return get_data_dir().'/contact-photos';
}
