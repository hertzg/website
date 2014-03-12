<?php

function get_revision ($key) {
    static $revisions = array(
        'common.compressed.css' => 3,
    );
    return $revisions[$key];
}
