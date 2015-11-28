<?php

function get_absolute_base () {
    include_once __DIR__.'/DomainName/get.php';
    include_once __DIR__.'/SiteBase/get.php';
    include_once __DIR__.'/SiteProtocol/get.php';
    return SiteProtocol\get().'://'.DomainName\get().SiteBase\get();
}
