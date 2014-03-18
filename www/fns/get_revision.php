<?php

function get_revision ($key) {
    static $revisions = array(
        'common.compressed.css' => 13,
        'icons.css' => 18,
    );
    return $revisions[$key];
}
