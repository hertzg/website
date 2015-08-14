<?php

function write_htaccess () {

    include_once __DIR__.'/SiteBase/get.php';
    $siteBase = SiteBase\get();

    include_once __DIR__.'/DomainName/get.php';
    $domainName = DomainName\get();
    $escapedDomainName = preg_quote($domainName);

    include_once __DIR__.'/SiteProtocol/get.php';
    $siteProtocol = SiteProtocol\get();

    $content =
        "# auto-generated\n"
        ."<FilesMatch \"\.(css|js|png|svg|ttf)$\">\n"
        ."    Header set Cache-Control \"public, max-age=31536000\"\n"
        ."</FilesMatch>\n"
        ."\n"
        ."RewriteEngine On\n"
        ."RewriteCond %{HTTP_HOST} ^www\.$escapedDomainName$\n"
        ."RewriteRule (.*) $siteProtocol://$domainName/$1 [R=301,L]\n"
        ."\n"
        ."DirectoryIndex index.php\n"
        ."\n"
        ."ErrorDocument 403 {$siteBase}403.php\n"
        ."ErrorDocument 404 {$siteBase}404.php\n";

    file_put_contents(__DIR__.'/../.htaccess', $content);

}
