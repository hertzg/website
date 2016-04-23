<?php

function get_values () {

    $key = 'install/general-info/values';
    if (array_key_exists($key, $_SESSION)) return $_SESSION[$key];

    $key = 'HTTP_HOST';
    if (array_key_exists($key, $_SERVER)) $domainName = $_SERVER[$key];
    else $domainName = $_SERVER['REMOTE_ADDR'];

    include_once '../../fns/SiteTitle/get.php';
    $siteTitle = SiteTitle\get();

    $documentRoot = $_SERVER['DOCUMENT_ROOT'];
    $file = substr($_SERVER['SCRIPT_FILENAME'], strlen($documentRoot));
    if (array_key_exists('REWRITE_ROOT_TO_WWW', $_SERVER)) {
        $remainingLength = strlen('www/install/general-info/index.php');
    } else {
        $remainingLength = strlen('install/general-info/index.php');
    }
    $siteBase = substr($file, 0, strlen($file) - $remainingLength);

    return [
        'siteTitle' => $siteTitle,
        'domainName' => $domainName,
        'infoEmail' => "info@$domainName",
        'siteBase' => $siteBase,
        'https' => array_key_exists('HTTPS', $_SERVER),
        'check' => false,
    ];

}
