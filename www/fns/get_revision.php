<?php

function get_revision ($key) {
    static $revisions = array(
        'common.compressed.css' => 14,
        'icons.css' => 19,
    );
    return $revisions[$key];
}
