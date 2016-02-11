<?php

namespace ApiCall;

function requireAdminUser () {

    include_once __DIR__.'/../../../fns/is_same_domain_referer.php';
    if (!is_same_domain_referer()) {
        include_once __DIR__.'/Error/forbidden.php';
        Error\forbidden('"CROSS_DOMAIN_REQUEST"');
    }

    include_once __DIR__.'/../require_admin.php';
    return require_admin();

}
