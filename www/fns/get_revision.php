<?php

function get_revision ($key) {
    static $revisions = array(
        'common.compressed.css' => 7,
    );
    return $revisions[$key];
}
