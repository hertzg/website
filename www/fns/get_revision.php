<?php

function get_revision ($key) {
    static $revisions = array(
        'common.compressed.css' => 11,
    );
    return $revisions[$key];
}
