<?php

function get_revision ($key) {
    static $revisions = array(
        'common.compressed.css' => 15,
        'icons.css' => 19,
    );
    return $revisions[$key];
}
