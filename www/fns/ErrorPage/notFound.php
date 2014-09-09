<?php

namespace ErrorPage;

function notFound () {
    include_once __DIR__.'/create.php';
    create(404, 'Not Found');
}
