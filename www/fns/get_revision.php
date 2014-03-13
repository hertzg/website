<?php

function get_revision ($key) {
    static $revisions = array(
        'common.compressed.css' => 9,
    );
    return $revisions[$key];
}
