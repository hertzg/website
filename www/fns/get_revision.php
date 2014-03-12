<?php

function get_revision ($key) {
    static $revisions = array(
        'common.compressed.css' => 4,
    );
    return $revisions[$key];
}
