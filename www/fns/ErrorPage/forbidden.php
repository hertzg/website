<?php

namespace ErrorPage;

function forbidden () {
    include_once __DIR__.'/create.php';
    create(403, 'Forbidden');
}
