<?php

function get_revision ($key) {
    static $revisions = array(
        'common.css' => 58,
    );
    return $key;
}
