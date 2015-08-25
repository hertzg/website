<?php

function phishing_warning () {
    include_once __DIR__.'/DomainName/get.php';
    include_once __DIR__.'/Page/infoText.php';
    include_once __DIR__.'/SiteBase/get.php';
    include_once __DIR__.'/SiteProtocol/get.php';
    return Page\infoText('The are accessing "<code>'
        .SiteProtocol\get().'://'.DomainName\get().SiteBase\get().'</code>".'
        .' The address in your browser\'s address bar should start with it.');
}
