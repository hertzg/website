<?php

function keyword_regex ($includes) {
    $parts = array_map(function ($include) {
        return preg_quote(htmlspecialchars($include));
    }, $includes);
    return '/('.join('|', $parts).')+/i';
}
