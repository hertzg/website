<?php

function get_revision ($key) {
    static $revisions = array(
        'common.css' => 59,
    );
    return $key;
}
