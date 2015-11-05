<?php

namespace ConnectionAddress;

function isValid ($address) {

    $parsed_url = parse_url($address);
    if ($parsed_url === false ||
        !array_key_exists('scheme', $parsed_url) ||
        !array_key_exists('path', $parsed_url) ||
        array_key_exists('query', $parsed_url) ||
        array_key_exists('fragment', $parsed_url)) return false;

    $scheme = $parsed_url['scheme'];
    if ($scheme !== 'http' && $scheme !== 'https') return false;

    include_once __DIR__.'/../DomainName/isValid.php';
    if (!\DomainName\isValid($parsed_url['host'])) return false;

    return true;

}
