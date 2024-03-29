<?php

function require_url (&$user, &$url, &$parsed_url) {

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/require_user.php";
    $user = require_user('../');

    include_once "$fnsDir/request_strings.php";
    list($url) = request_strings('url');

    $parsed_url = parse_url($url);

    if ($parsed_url === false ||
        !array_key_exists('scheme', $parsed_url) ||
        !in_array($parsed_url['scheme'], ['http', 'https']) ||
        !array_key_exists('host', $parsed_url) ||
        array_key_exists('fragment', $parsed_url)) {

        include_once "$fnsDir/redirect.php";
        redirect('../home/');

    }

}
