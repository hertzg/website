<?php

function get_revision ($key) {
    static $revisions = array(
        'common.compressed.css' => 16,
        'icons.css' => 20,
    );
    return $revisions[$key];
}
