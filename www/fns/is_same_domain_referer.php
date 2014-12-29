<?php

function is_same_domain_referer () {
    if (array_key_exists('HTTP_REFERER', $_SERVER)) {
        $host = parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST);
        if ($host !== $_SERVER['SERVER_NAME']) return false;
    }
    return true;
}
