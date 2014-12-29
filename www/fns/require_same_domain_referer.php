<?php

function require_same_domain_referer ($base) {
    include_once __DIR__.'/is_same_domain_referer.php';
    if (!is_same_domain_referer()) {
        include_once __DIR__.'/redirect.php';
        redirect($base);
    }
}
