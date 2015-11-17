<?php

function is_same_domain_referer () {

    if (array_key_exists('HTTP_REFERER', $_SERVER)) {
        $host = parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST);
        if ($host !== $_SERVER['SERVER_NAME']) return false;
    }

    include_once __DIR__.'/request_strings.php';
    list($just_signed_in) = request_strings('just_signed_in');
    if ($just_signed_in) return false;

    return true;

}
