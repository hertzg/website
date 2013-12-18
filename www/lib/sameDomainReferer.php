<?php

$sameDomainReferer = true;
if (array_key_exists('HTTP_REFERER', $_SERVER)) {
    if (parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST) !== $_SERVER['SERVER_NAME']) {
        $sameDomainReferer = false;
    }
}
