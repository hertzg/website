<?php

function restore_expires ($expire_time) {
    if ($expire_time === null || $expire_time < time()) return 'never';
    $days = round(($expire_time - time()) / (60 * 60 * 24));
    if (!$days) $days = 1;
    return (string)$days;
}
