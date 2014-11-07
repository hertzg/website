<?php

namespace ContactPhotos;

function path ($id) {
    include_once __DIR__.'/dir.php';
    return dir()."/$id";
}
