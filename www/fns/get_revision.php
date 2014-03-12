<?php

function get_revision ($key) {
    static $revisions = array(
        'common.compressed.css' => 6,
    );
    return $revisions[$key];
}
