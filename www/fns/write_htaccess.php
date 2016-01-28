<?php

function write_htaccess ($siteBase, $domainName, $siteProtocol) {

    $escapedDomainName = preg_quote($domainName);

    $content =
        "# auto-generated\n"
        ."SetEnv HTACCESS_WORKING 1\n"
        ."\n"
        ."RewriteEngine on\n"
        ."\n"
        ."RewriteCond %{HTTP_HOST} ^www\.$escapedDomainName$\n"
        ."RewriteRule (.*) $siteProtocol://$domainName/$1 [R=301,L]\n"
        ."\n"
        ."<IfModule mod_headers.c>\n"
        ."    <FilesMatch \"\.(css|js|png|svg|ttf)$\">\n"
        ."        Header set Cache-Control \"public, max-age=31536000\"\n"
        ."    </FilesMatch>\n"
        ."</IfModule>\n"
        ."\n"
        ."DirectoryIndex index.php\n"
        ."\n"
        ."ErrorDocument 403 {$siteBase}403.php\n"
        ."ErrorDocument 404 {$siteBase}404.php\n";

    file_put_contents(__DIR__.'/../.htaccess', $content);

}
