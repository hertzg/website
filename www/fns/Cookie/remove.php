<?php

namespace Cookie;

function remove ($name) {
    include_once __DIR__.'/../SiteBase/get.php';
    setcookie($name, '', time() - 60 * 60 * 24 * 30, \SiteBase\get());
}
