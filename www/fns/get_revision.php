<?php

function get_revision ($key) {
    static $revisions = array(
        'common.compressed.css' => 10,
    );
    return $revisions[$key];
}
