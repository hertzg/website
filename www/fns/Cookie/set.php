<?php

namespace Cookie;

function set ($name, $value) {
    include_once __DIR__.'/../SiteBase/get.php';
    setcookie($name, $value, time() + 60 * 60 * 24 * 30, \SiteBase\get());
}
