<?php

namespace Users\Directory;

function dir () {

    include_once __DIR__.'/../../get_data_dir.php';
    $data_dir = get_data_dir();

    return "$data_dir/users";

}
