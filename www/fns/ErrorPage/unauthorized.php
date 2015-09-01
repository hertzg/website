<?php

namespace ErrorPage;

function unauthorized ($www_authenticate) {

    $description = "The page "
        .'<em>'.htmlspecialchars($_SERVER['REQUEST_URI']).'</em>'
        .' requires authentication.';

    include_once __DIR__.'/create.php';
    create(401, 'Unauthorized', $description, function () use (
        $www_authenticate) {

        header("WWW-Authenticate: $www_authenticate");

    });

}
