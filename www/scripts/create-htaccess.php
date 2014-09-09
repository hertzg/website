#!/usr/bin/php
<?php

chdir(__DIR__);
include_once 'lib/require-cli.php';

include_once '../fns/get_site_base.php';
$siteBase = get_site_base();

$content =
    "# auto-generated\n"
    ."RewriteEngine On\n\n"
    ."RewriteCond %{HTTP_HOST} ^www\.zvini\.com$\n"
    ."RewriteRule (.*) https://zvini.com/$1 [R=301,L]\n\n"
    ."RewriteCond %{HTTPS} !^on$\n"
    ."RewriteCond %{HTTP_HOST} ^zvini\.com$\n"
    ."RewriteCond %{REQUEST_URI} !^/manifest.php$\n"
    ."RewriteRule (.*) https://zvini.com/$1 [R=301,L]\n\n"
    ."<filesMatch \"\.(css|js|svg)$\">\n"
    ."    Header set Cache-Control \"public, max-age=2592000\"\n"
    ."</filesMatch>\n\n"
    ."DirectoryIndex index.php\n\n"
    ."ErrorDocument 403 {$siteBase}403.php\n"
    ."ErrorDocument 404 {$siteBase}404.php\n";

file_put_contents('../.htaccess', $content);
