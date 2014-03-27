<?php

function get_revision ($key) {
    static $revisions = array(
        'common.compressed.css' => 17,
        'icons.css' => 21,
    );
    return $revisions[$key];
}
