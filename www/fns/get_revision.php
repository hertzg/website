<?php

function get_revision ($key) {
    static $revisions = array(
        'compressed.css' => 2,
    );
    return $revisions[$key];
}
