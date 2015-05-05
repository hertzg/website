<?php

namespace ErrorPage;

function internalServerError () {

    $description = 'The page '
        .'<em>'.htmlspecialchars($_SERVER['REQUEST_URI']).'</em>'
        .' has failed to load.';

    include_once __DIR__.'/create.php';
    create(500, 'Internal Server Error', $description);

}
