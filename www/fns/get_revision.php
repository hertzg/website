<?php

function get_revision ($key) {
    static $revisions = array(
        'common.css' => 61,
    );
    return $key;
}
