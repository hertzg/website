<?php

function get_revision ($key) {
    static $revisions = array(
        'common.css' => 60,
    );
    return $key;
}
