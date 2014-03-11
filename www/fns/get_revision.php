<?php

function get_revision ($key) {
    static $revisions = array(
        'compressed.css' => 1,
    );
    return $revisions[$key];
}
