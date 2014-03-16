<?php

function get_revision ($key) {
    static $revisions = array(
        'common.compressed.css' => 12,
        'icons.css' => 17,
    );
    return $revisions[$key];
}
