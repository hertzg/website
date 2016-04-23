<?php

namespace NumReverseProxies;

function available () {
    $options = ['0 / '.$_SERVER['REMOTE_ADDR']];
    if (array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER)) {
        $parts = explode(', ', $_SERVER['HTTP_X_FORWARDED_FOR']);
        while ($parts) {
            $part = htmlspecialchars(array_pop($parts));
            $options[] = count($options)." / $part";
        }
    }
    return $options;
}
