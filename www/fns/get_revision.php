<?php

function get_revision ($key) {
    static $revisions = array(
        'common.compressed.css' => 8,
    );
    return $revisions[$key];
}
