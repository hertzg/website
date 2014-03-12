<?php

function get_revision ($key) {
    static $revisions = array(
        'common.compressed.css' => 2,
    );
    return $revisions[$key];
}
