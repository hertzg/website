<?php

namespace ErrorPage;

function internalServerError ($error) {

    $reference = bin2hex(openssl_random_pseudo_bytes(20));
    error_log("$reference: $error");

    $description = 'The page '
        .'<em>'.htmlspecialchars($_SERVER['REQUEST_URI']).'</em>'
        .' has failed to load.<br /><br />'
        .'<div style="font-size: 12px; color: #7f7f7f">'
            .'Reference: '
            ."<span style=\"word-wrap: break-word\">$reference</span>"
        .'</div>';

    include_once __DIR__.'/create.php';
    create(500, 'Internal Server Error', $description);

}
