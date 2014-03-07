<?php

function get_revision ($key) {
    static $revisions = array(
        'common.css' => 57,
    );
    return $key;
}
