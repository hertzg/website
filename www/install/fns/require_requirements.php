<?php

function require_requirements () {

    include_once __DIR__.'/require_not_installed.php';
    require_not_installed();

    $rootDir = __DIR__.'/../..';
    $apacheModules = apache_get_modules();

    if (!in_array('mod_rewrite', $apacheModules) ||
        !in_array('mod_headers', $apacheModules) ||
        !date_default_timezone_get() === 'UTC' ||
        !function_exists('curl_init') ||
        !function_exists('imagecreatefromstring') ||
        !function_exists('mysqli_connect') ||
        !is_writable("$rootDir/admin/fns/get_admin.php") ||
        !is_writable("$rootDir/fns/get_domain_name.php") ||
        !is_writable("$rootDir/fns/get_mysqli_config.php") ||
        !is_writable("$rootDir/fns/get_site_base.php") ||
        !is_writable("$rootDir/fns/installed.php")) {

        include_once __DIR__.'/../../fns/redirect.php';
        redirect('../requirements/');

    }

}
