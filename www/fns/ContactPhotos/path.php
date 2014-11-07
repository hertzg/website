<?php

namespace ContactPhotos;

function path ($id) {

    include_once __DIR__.'/../get_data_dir.php';
    $data_dir = get_data_dir();

    return "$data_dir/contact-photos/$id";

}
