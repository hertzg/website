<?php

namespace ErrorPage;

function internalServerError () {
    include_once __DIR__.'/create.php';
    create(500, 'Internal Server Error');
}
