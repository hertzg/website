<?php

function require_requirements () {

    include_once __DIR__.'/require_agreement.php';
    require_agreement();

    $rootDir = __DIR__.'/../..';
    $apacheModules = apache_get_modules();

    if (!in_array('mod_rewrite', $apacheModules) ||
        !in_array('mod_headers', $apacheModules) ||
        date_default_timezone_get() !== 'UTC' ||
        !function_exists('curl_init') ||
        !function_exists('imagecreatefromstring') ||
        !function_exists('mysqli_connect') ||
        !is_writable($rootDir) ||
        !is_writable("$rootDir/admin/fns/get_admin.php") ||
        !is_writable("$rootDir/fns/get_domain_name.php") ||
        !is_writable("$rootDir/fns/InfoEmail/get.php") ||
        !is_writable("$rootDir/fns/MysqlConfig/get.php") ||
        !is_writable("$rootDir/fns/get_site_base.php") ||
        !is_writable("$rootDir/fns/get_site_protocol.php") ||
        !is_writable("$rootDir/fns/installed.php")) {

        include_once "$rootDir/fns/redirect.php";
        redirect('../requirements/');

    }

}
