#!/usr/bin/php
<?php

chdir(__DIR__);
include_once '../../lib/cli.php';

include_once '../fns/SiteBase/get.php';
$siteBase = SiteBase\get();

include_once '../fns/DomainName/get.php';
$domainName = DomainName\get();
$escapedDomainName = preg_quote($domainName);

include_once '../fns/SiteProtocol/get.php';
$siteProtocol = SiteProtocol\get();

$forceHttps = false;

$content =
    "# auto-generated\n"
    ."RewriteEngine On\n"
    ."\n"
    ."RewriteCond %{HTTP_HOST} ^www\.$escapedDomainName$\n"
    ."RewriteRule (.*) $siteProtocol://$domainName/$1 [R=301,L]\n"
    ."\n";
if ($siteProtocol == 'https' && $forceHttps) {
    $content .=
        "RewriteCond %{HTTPS} !^on$\n"
        ."RewriteCond %{HTTP_HOST} ^$escapedDomainName$\n"
        ."RewriteRule (.*) https://$domainName/$1 [R=301,L]\n"
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
