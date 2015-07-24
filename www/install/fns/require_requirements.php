<?php

function require_requirements () {

    include_once __DIR__.'/require_agreement.php';
    require_agreement();

    $rootDir = __DIR__.'/../..';
    $apacheModules = apache_get_modules();

    if (!in_array('mod_rewrite', $apacheModules) ||
        !in_array('mod_headers', $apacheModules) ||
        date_default_timezone_get() !== 'UTC' ||
        !extension_loaded('curl') || !extension_loaded('gd') ||
        !extension_loaded('gmp') || !extension_loaded('mysql') ||
        !is_writable("$rootDir/data/contact-photos") ||
        !is_writable("$rootDir/data/users") ||
        !is_writable("$rootDir/.htaccess") ||
        !is_writable("$rootDir/fns/Admin/get.php") ||
        !is_writable("$rootDir/fns/ClientAddress/get.php") ||
        !is_writable("$rootDir/fns/ClientAddress/GetMethod/get.php") ||
        !is_writable("$rootDir/fns/DomainName/get.php") ||
        !is_writable("$rootDir/fns/InfoEmail/get.php") ||
        !is_writable("$rootDir/fns/Installed/get.php") ||
        !is_writable("$rootDir/fns/MysqlConfig/get.php") ||
        !is_writable("$rootDir/fns/SiteBase/get.php") ||
        !is_writable("$rootDir/fns/SiteProtocol/get.php") ||
        !is_writable("$rootDir/fns/SiteTitle/get.php")) {

        include_once "$rootDir/fns/redirect.php";
        redirect('../requirements/');

    }

}
