<?php

function create_external_url ($url, $base) {
    return $base.'redirect/?url='.rawurlencode($url);
}
