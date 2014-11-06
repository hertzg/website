<?php

function file_put_php ($filename, $content) {
    $ok = file_put_contents($filename, $content);
    if ($ok && function_exists('opcache_invalidate')) {
        opcache_invalidate($filename);
    }
    return $ok;
}
