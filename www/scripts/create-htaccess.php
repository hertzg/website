#!/usr/bin/php
<?php

chdir(__DIR__);
include_once '../../lib/cli.php';

include_once '../fns/get_site_base.php';
$siteBase = get_site_base();

include_once '../fns/get_domain_name.php';
$domain_name = get_domain_name();
$escaped_domain_name = preg_quote($domain_name);

include_once '../fns/get_site_protocol.php';
$site_protocol = get_site_protocol();

$forceHttps = false;

$content =
    "# auto-generated\n"
    ."RewriteEngine On\n"
    ."\n"
    ."RewriteCond %{HTTP_HOST} ^www\.$escaped_domain_name$\n"
    ."RewriteRule (.*) $site_protocol://$domain_name/$1 [R=301,L]\n"
    ."\n";
if ($site_protocol == 'https' && $forceHttps) {
    $content .=
        "RewriteCond %{HTTPS} !^on$\n"
        ."RewriteCond %{HTTP_HOST} ^$escaped_domain_name$\n"
        ."RewriteRule (.*) https://$domain_name/$1 [R=301,L]\n"
        ."\n";
}
$content .=
    "<filesMatch \"\.(css|js|png|svg|ttf)$\">\n"
    ."    Header set Cache-Control \"public, max-age=2592000\"\n"
    ."</filesMatch>\n"
    ."\n"
    ."DirectoryIndex index.php\n"
    ."\n"
    ."ErrorDocument 403 {$siteBase}403.php\n"
    ."ErrorDocument 404 {$siteBase}404.php\n";

file_put_contents('../.htaccess', $content);
