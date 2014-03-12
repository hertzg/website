<?php

function get_revision ($key) {
    static $revisions = array(
        'common.compressed.css' => 5,
    );
    return $revisions[$key];
}
