<?php

function format_return ($return) {

    if ($return === '') return;

    $parsed_url = parse_url($return);
    if ($parsed_url === false ||
        array_key_exists('scheme', $parsed_url) ||
        array_key_exists('host', $parsed_url) ||
        array_key_exists('fragment', $parsed_url)) return;

    if (array_key_exists('query', $parsed_url)) $return .= '&';
    else $return .= '?';
    $return .= 'just_signed_in=1';
    return $return;

}
