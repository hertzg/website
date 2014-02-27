<?php

function require_same_domain_referer ($base) {
    $same_domain_referer = true;
    if (array_key_exists('HTTP_REFERER', $_SERVER)) {
        $host = parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST);
        if ($host !== $_SERVER['SERVER_NAME']) {
            $same_domain_referer = false;
        }
    }
    if (!$same_domain_referer) {
        include_once __DIR__.'/redirect.php';
        redirect($base);
    }
}
